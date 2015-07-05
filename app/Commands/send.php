<?php

declare(ticks = 1); // how often to check for signals
// These define the signal handling
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP,  "sig_handler");
pcntl_signal(SIGINT, "sig_handler");

define('NEWLINE' ,"\n");
global $campaign_id, $id_hundler, $fraction;
if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
    $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
}

//$myarg = "0,1,2,3|from 3|subject-3|From: soufiane elh <soufiane@good.somsales.com>
//Content-Type: text/plain;
//|apachee send 100|4|500";
//$params = explode('|',$myarg);
$params = explode('|',$argv[1]);
$campaign_id = $argv[2];
$id_hundler = ( count($argv) > 3 ? $argv[3] : 0 ) ; //($var > 2 ? true : false);
$send = new Send($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);
$fraction = $params[7];
exec("echo starts >> out.txt");
$return = $send->run();
exec("echo ends >> out.txt");
$time_taken = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
exec("echo {$time_taken} >> out.txt");
set_sent($campaign_id,$return);

function sig_handler($signo){ // this function will process sent signals
    if ($signo == SIGTERM || $signo == SIGHUP || $signo == SIGINT /*|| $signo == SIGSTOP*/){
        sleep(2);
        set_paused();
        exit();
    }
}

function msg_vmta($compteur, $msg_vmta, $nbr_vmta){
    $result = (int) ($compteur / $msg_vmta);
    if ($result >= $msg_vmta && $msg_vmta > $nbr_vmta) {
        $result = $result % $msg_vmta;
    }
    if ($compteur >= $msg_vmta * $nbr_vmta) {
        $tmp = $compteur % ($msg_vmta * $nbr_vmta);
        $result = (int) ($tmp / $msg_vmta);
    }
    return $result;
}

function rotate($counter, $step, $array_length){
    $result = (int) ($counter / $step);
    if ($result >= $step && $step > $array_length) {
        $result = $result % $step;
    }
    if ($counter >= $step * $array_length) {
        $tmp = $counter % ($step * $array_length);
        $result = (int) ($tmp / $step);
    }
    return $result;
}
// to create 1 function for set_paused & set_sent
function set_paused(){
    global $campaign_id, $id_hundler;
    echo 'paused'.NEWLINE;
    if(!$id_hundler){
        echo "can't return << $campaign_id >> !!".NEWLINE;
        return false;
    }
    $db = connect_to_db();
    //return = old.return + return;
    $query = "UPDATE `queues` SET `status` = '2', `return` = {$id_hundler},`pid` = 'null' WHERE `campaign_id` = {$campaign_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error .NEWLINE;
        return flase;
    }
    return true;
}

function set_sent($campaign_id, $return){
    if(!$return){
        echo "no return << campaign_id: $campaign_id >> !!".NEWLINE;
        return false;
    }
    $db = connect_to_db();

    $query = "UPDATE `queues` SET `status` = '1', `return` =  {$return},`pid` = 'null' WHERE `campaign_id` = {$campaign_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error .NEWLINE;
        return flase;
    }
    return true;
}

function connect_to_db() {
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'som_list');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: ( $mysqli->connect_errno ) $mysqli->connect_error".NEWLINE;
        return;
    }

    return $mysqli;
}

class Send {
    public $vmta = array('MTA-146.247.24.68-gmail','MTA-146.247.24.69-gmail','MTA-146.247.24.91-gmail','MTA-146.247.24.92-gmail');

    public $ips;
    public $from;
    public $subject;
    public $headers;
    public $message;
    public $msg_vmta;
    public $msg_conn;
    public $delay;

    public $current_server;
    public $current_i_server;
    public $nbr_vmta ;


    public function Send($ips, $from, $subject, $headers, $message, $msg_vmta, $delay )
    {
        $this->ips = explode(',', trim($ips));
        $this->from = trim($from);
        $this->subject = trim($subject);
        $this->headers = trim($headers);
        $this->message = trim($message);
        $this->msg_vmta =  (int) $msg_vmta;
        $this->delay = (int) $delay;

        $this->nbr_vmta = count($this->ips);

        $res = []; // $res : array of ips grouped by id_server
        foreach($this->ips as $value){
            $tmp = explode('-', $value);
            if(isset($res[$tmp[0]]))
                $res[$tmp[0]] .= ','.$tmp[1];
            else
                $res[$tmp[0]] = $tmp[1];
        }
        $this->ips = $res;
    }

    public function manageConnection(Connection $connection, $i){

        if($i == 0){
            if($connection->isOpen())
                $connection->close();
            $this->setCurrentServer(0);
            $connection->HOST = $this->current_server['ip'];
            $connection->open();
            //$connection->helo();
            return $connection;
        }


        if(!$connection->isOpen()){
            $this->setCurrentServer(0);
            echo "rotate ";
            $next_server = rotate($i,$this->msg_vmta * count($this->current_server['vmta']),count($this->ips));
            $this->setCurrentServer($next_server);
            $connection->HOST = $this->current_server['ip'];
            $connection->open();
            //$connection->helo();
            return $connection;
        }

        if($i % $this->msg_conn == 0){
            if($connection->isOpen())
                $connection->close();
            $next_server = rotate($this->current_i_server+1,1,count($this->ips));
            $this->setCurrentServer($next_server);
            $connection->HOST = $this->current_server['ip'];
            $connection->open();
            //$connection->helo();
            return $connection;
        }

        return $connection;
    }

    public function setCurrentServer($index){
        $indx = array_keys($this->ips);
        $id_server = $indx[$index];
        $server = [];
        $db = connect_to_db();
        $query = "select `main_ip` from `servers` where `id`= {$id_server} ; ";
        $result = $db->query($query) or die ("no query");
        if ($result->num_rows <= 0) {
            echo "0 results".NEWLINE;
        } else {
            $server['ip'] = $result->fetch_row()[0];
        }

        $query = "select `vmta` from `ips` where `id` in ({$this->ips[$id_server]}) ; ";
        if ($stmt = $db->prepare($query)) {

            $stmt->execute();
            $stmt->bind_result($vmta);

            /* Lecture des valeurs */
            while ($stmt->fetch()) {
                $server['vmta'][] = $vmta;
            }
            $stmt->close();
        }

        $db->close();
        $this->current_server = $server; // return
        $this->current_i_server = $index; // return
        $this->msg_conn = count($this->current_server['vmta'])*$this->msg_vmta;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function run()
    {

        $handle = fopen("data.csv", "r") or die("Couldn't open file (data)");
        global $id_hundler, $fraction;
        $id = 0; //$id_hundler = $id;
        $connection = new Connection(7543);

        if ($handle) {
//            $connection->open(); //helo !!
//            $connection->helo();
            while (($line = fgets($handle)) && ($id_hundler < $fraction)) {

                if($id < $id_hundler){
                    $id++;
                    continue;
                }
                $connection = $this->manageConnection($connection,$id); // exception if resume sending !!

                $elemt = explode("|",$line);
                $email = $elemt[1];

                $tmp_mail = new Mail();
                $tmp_mail->RCPT_TO = $email;
                $tmp_mail->MAIL_FROM = $this->from;

                $i = msg_vmta($id,$this->msg_vmta,count($this->current_server['vmta']));
                $vmta = $this->current_server['vmta'][$i];

                $tmp_mail->prepare($vmta, $this->subject, $this->message , $this->headers);

//                if($id % $this->msg_conn == 0 && $id != 0){
//                    $connection->close();
//                    $connection->open();
//                    $connection->helo();
//                }

                $connection->send($tmp_mail) ;
                $id++;$id_hundler++;
            }
            fclose($handle);
            $connection->close();
        }
        echo "{$id}".NEWLINE;
        return $id_hundler;
    }

}

class Connection
{
    public $HOST;
    public $PORT = 25;
    public $timeout = 30;
    public $socket_context;
    public $stream; //connection
    public $response = '';

    function __construct($port)
    {
        $this->PORT = $port;
    }

    function Connection($host,$port){
        $this->HOST = $host;
        $this->PORT = $port;
    }

    public function isOpen(){
        if($this->stream)
            return true;
        return false;
    }

    function open(){
        //echo "from open -- ";

        $this->socket_context = stream_context_create(array());
        $this->stream = stream_socket_client($this->HOST . ":" . $this->PORT,
            $errno, $errstr, $this->timeout, STREAM_CLIENT_CONNECT, $this->socket_context);
        if (!$this->stream) {
            echo "$errstr ($errno)".NEWLINE;
            return flase;
        }
        return true;
    }

    function command($cmd) {
        fwrite($this->stream, $cmd . NEWLINE) ;
    }
    function helo(){
        if($this->stream == null){
            echo "can't hello .. no connection".NEWLINE;
            return false;
        }
        //echo 'from helo';
        $this->command("HELO somsales.com");
    }

    function Send($mail){
        //echo "from send -- ";
        if($this->stream == null){
            echo "can't send .. no connection".NEWLINE;
            return false;
        }
        //$this->command("HELO sure.somsales.com");
        $this->command("MAIL FROM: <$mail->MAIL_FROM>");
        $this->command("RCPT TO: <$mail->RCPT_TO>");
        $this->command("DATA");
        $this->command($mail->DATA['headers']);
        $this->command(NEWLINE);
        $this->command($mail->DATA['body']);
        $this->command(".");
        fgets($this->stream, 4096);
    }


    function close(){
        if($this->stream == null){
            echo "can't close .. no connection".NEWLINE;
            return false;
        }
        echo "close $this->HOST -- ".NEWLINE;
        $this->command('QUIT');
        $this->response = stream_get_contents($this->stream);
        //echo 'res = '. $this->response;

        if (is_resource($this->stream)){
            fclose($this->stream);
            $this->stream = null;
        }
    }
}

class Mail {
    public $RCPT_TO;
    public $MAIL_FROM;
    public $HOST;
    public $PORT = 7543;
    public $DATA = array('headers' => '', 'body' => '' );

    public $connection;
    public $timeout = 30;
    public $socket_context;
    public $response = '';

    function prepare($vmta, $subject, $msg, $headers){
        //$this->RCPT_TO = $to;$this->addheader('To',$to);
        $this->DATA['headers'] = $headers . NEWLINE;
        $this->addheader('x-virtual-mta', $vmta);
        $this->addheader('Subject',$subject);
        $this->addheader('To',$this->RCPT_TO);
        $this->addheader('MIME-Version','1.0');
        $this->DATA['body'] = $msg;
    }

    function set_params($host, $port, $from) {
        $this->HOST = $host;
        $this->PORT = $port;
        $this->MAIL_FROM = $from;
    }

    function addheader($name, $value){
        $this->DATA['headers'] .=  $name . ': ' . $value . NEWLINE;
    }

}

