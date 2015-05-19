<?php
/**
 * Created by PhpStorm.
 * User: soufiane
 * Date: 25/05/2015
 * Time: 17:00
 */

namespace app\Commands;

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

//    function connect(){
//        $this->socket_context = function_exists('stream_socket_client');
//        if ($this->socket_context){ // if true : function exist
//            $this->socket_context = stream_context_create(array());
//            $this->connection = @stream_socket_client($this->HOST . ":" . $this->PORT,
//                $errno, $errstr, $this->timeout, STREAM_CLIENT_CONNECT, $this->socket_context);
//            return true;
//        }
//        else {
//            echo "Connection: stream_socket_client not available, falling back to fsockopen";
//            return false;
//        }
//    }


//    function command($cmd) {
//        fwrite($this->connection, $cmd . NEWLINE) ;
//    }

//    function Send($connection){
//
//        if($connection == null){
//            echo ' => connection == null';
//            return false;
//        }
//        $this->connection = $connection;
//
//        if($this->connection == null){
//            echo ' => conn == null';
//            return false;
//        }
//
//        $this->command("HELO sure.somsales.com");
//        $this->command("MAIL FROM: <$this->MAIL_FROM>");
//        $this->command("RCPT TO: <$this->RCPT_TO>");
//        $this->command("DATA");
//        $this->command($this->DATA['headers']);
//        $this->command(NEWLINE);
//        $this->command($this->DATA['body']);
//        $this->command(".");
//    }

//    function close($content = ''){
//        $this->command('QUIT');
//    }

}


