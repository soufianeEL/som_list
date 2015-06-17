#!/usr/bin/php
<?php
//require __DIR__.'/../../bootstrap/autoload.php';

declare(ticks = 1); // how often to check for signals
// These define the signal handling
pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGHUP,  "sig_handler");
pcntl_signal(SIGINT, "sig_handler");

define('NEWLINE' ,"\n");
global $queue_id, $id_hundler;
if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
    $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
}

$myarg = "0,1,2,3|from 3|subject-3|From: soufiane elh <soufiane@good.somsales.com>
Content-Type: text/plain;
|apachee send 100|4|500";
$params = explode('|',$myarg);
$queue_id = 4 ;
//$params = explode('|',$argv[1]);
//$queue_id = $argv[2];

$send = new Send($params[0],$params[1],$params[2],$params[3],$params[4],$params[5],$params[6]);

exec("echo starts >> out.txt");
$return = $send->run();
exec("echo ends >> out.txt");
$time_taken = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
exec("echo {$time_taken} >> out.txt");
set_sent($queue_id,$return);

function sig_handler($signo){ // this function will process sent signals
    if ($signo == SIGTERM || $signo == SIGHUP || $signo == SIGINT /*|| $signo == SIGSTOP*/){
        sleep(1);
        set_paused();
        exit();
    }
}

function set_paused(){
    global $queue_id, $id_hundler;
    echo 'from set_paused';
    if(!$id_hundler){
        echo " no return << $queue_id >> !!";
        return false;
    }
    $db = connect_to_db();

    $query = "UPDATE `queues` SET `status` = '2', `return` = {$id_hundler},`pid` = 'null' WHERE `id` = {$queue_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error;
        return flase;
    }
    return true;
}


function set_sent($queue_id, $return){
    if(!$return){
        echo " no return << $queue_id >> !!";
        return false;
    }
    $db = connect_to_db();

    $query = "UPDATE `queues` SET `status` = '1', `return` = {$return},`pid` = 'null' WHERE `id` = {$queue_id}; ";
    $result = $db->query($query);

    if (!$result) {
        echo "Update record failed: (" . $db->errno . ") " . $db->error;
        return flase;
    }
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

    public function __construct($ips, $from, $subject, $headers, $message, $msg_vmta, $msg_conn )
    {
        $this->ips = explode(',', trim($ips));
        $this->from = trim($from);
        $this->subject = trim($subject);
        $this->headers = trim($headers);
        $this->message = trim($message);
        $this->msg_vmta = trim($msg_vmta);
        $this->msg_conn = trim($msg_conn);

        $this->nbr_vmta = count($ips);
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function run()
    {

        $handle = fopen("data.csv", "r") or die("Couldn't open file (data)");
        global $id_hundler;
        $id = 0; $id_hundler = $id;
        $connection = new Connection('somsales.com',7543);

        if ($handle) {
            $connection->open(); //helo !!
            $connection->helo();
            while ($line = fgets($handle)) {
                $elemt = explode("|",$line);
                $email = $elemt[1];

                $tmp_mail = new Mail();
                $tmp_mail->RCPT_TO = $email;
                $tmp_mail->MAIL_FROM = $this->from;

                $i = $this->msg_vmta($id,$this->msg_vmta,$this->nbr_vmta);
                $id_vmta = $this->ips[$i];

                $tmp_mail->prepare($this->vmta[$id_vmta], $this->subject, $this->message , $this->headers);

                if($id % $this->msg_conn == 0 && $id != 0){
                    $connection->close();
                    $connection->open();
                    $connection->helo();
                }

                $connection->send($tmp_mail) ;
                $id++;$id_hundler = $id;
            }
            fclose($handle);
            $connection->close();
        }
        echo "nbr line = {$id} \n";
        return $id;
    }

    public function msg_vmta($compteur, $msg_vmta, $nbr_vmta){
        $result = (int) ($compteur / $msg_vmta);

        if ($result >= $msg_vmta && $msg_vmta > $nbr_vmta) {
            $result = $result % $msg_vmta ;
        }
        if ($compteur >= $msg_vmta * $nbr_vmta) {
            $tmp = $compteur % ($msg_vmta * $nbr_vmta);
            $result = (int) ($tmp / $msg_vmta);
        }
        return $result;
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

