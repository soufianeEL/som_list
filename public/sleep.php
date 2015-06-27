<?php

define('NEWLINE' ,"\n");
global $campaign_id, $id_hundler;
if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
    $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
}

$c = new Connection('somsales.com',7543);
var_dump($c->isOpen());
$c->open();
var_dump($c->isOpen());
$c->helo();
echo fgets($c->stream,16);
fseek($c->stream,16);
echo fgets($c->stream,16);
fseek($c->stream,16);
echo fgets($c->stream);
$c->close();
var_dump($c->isOpen());


die('ook');

function setCurrentServer($res2, $index){
    $indx = array_keys($res2);
    $id_server = $indx[$index];
    $server = [];
    $db = connect_to_db();
    $query = "select `main_ip` from `servers` where `id`= {$id_server} ; ";
    $result = $db->query($query) or die ("no query");
    if ($result->num_rows <= 0) {
        echo "0 results";
    } else {
        $server['ip'] = $result->fetch_row()[0];
    }

    $query = "select `vmta` from `ips` where `id` in ({$res2[$id_server]}) ; ";
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
    return $server;
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

function set_paused(){
    global $campaign_id, $id_hundler;
    echo 'from set_paused';
    if(!$id_hundler){
        echo " no return << $campaign_id >> !!";
        return false;
    }
    $db = connect_to_db();
    //return = old.return + return;
    $query = "UPDATE `queues` SET `status` = '2', `return` = {$id_hundler},`pid` = 'null' WHERE `campaign_id` = {$campaign_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error;
        return flase;
    }
    $db->close();
    return true;
}

function set_sent($campaign_id, $return){
    if(!$return){
        echo " no return << $campaign_id >> !!";
        return false;
    }
    $db = connect_to_db();

    $query = "UPDATE `queues` SET `status` = '1', `return` =  {$return},`pid` = 'null' WHERE `campaign_id` = {$campaign_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error;
        return flase;
    }
    $db->close();
    return true;
}

function connect_to_db() {
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'som_list');

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: ( $mysqli->connect_errno ) $mysqli->connect_error";
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

    public $nbr_vmta ;


    public function Send($ips, $from, $subject, $headers, $message, $msg_vmta, $msg_conn )
    {
        $this->ips = explode(',', trim($ips));
        $this->from = trim($from);
        $this->subject = trim($subject);
        $this->headers = trim($headers);
        $this->message = trim($message);
        $this->msg_vmta =  (int) $msg_vmta;
        $this->msg_conn = (int) $msg_conn;

        $this->nbr_vmta = count($this->ips);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function run()
    {

//        $handle = fopen("data.csv", "r") or die("Couldn't open file (data)");
        $handle = fopen("data.csv", "r") or die("Couldn't open file (data)");
        global $id_hundler;
        $id = 0; //$id_hundler = $id;
        $connection = new Connection('somsales.com',7543);

        if ($handle) {
            $connection->open(); //helo !!
            $connection->helo();
            while ($line = fgets($handle)) {

                if($id < $id_hundler){
                    $id++;
                    continue;
                }
                $elemt = explode("|",$line);
                $email = $elemt[1];

                $tmp_mail = new Mail();
                $tmp_mail->RCPT_TO = $email;
                $tmp_mail->MAIL_FROM = $this->from;

                $i = msg_vmta($id,$this->msg_vmta,$this->nbr_vmta);
                $id_vmta = $this->ips[$i];

                $tmp_mail->prepare($this->vmta[$id_vmta], $this->subject, $this->message , $this->headers);

                if($id % $this->msg_conn == 0 && $id != 0){
                    $connection->close();
                    $connection->open();
                    $connection->helo();
                }

                $connection->send($tmp_mail) ;
                $id++;$id_hundler++;
            }
            fclose($handle);
            $connection->close();
        }
        echo "{$id} \n";
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

    function __construct($host,$port)
    {
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
            echo "$errstr ($errno) <br/>\n";
            return flase;
        }
        return true;
    }

    function command($cmd) {
        fwrite($this->stream, $cmd . NEWLINE) ;
    }
    function helo(){
        if($this->stream == null){
            echo ' => conn == null';
            return false;
        }
        //echo 'from helo';
        $this->command("HELO somsales.com");
    }

    function Send($mail){
        //echo "from send -- ";
        if($this->stream == null){
            echo ' => conn == null';
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
    }


    function close(){
        //echo "from close -- ".NEWLINE;
        if($this->stream == null){
            echo ' => connnnn == null';
            return false;
        }
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

