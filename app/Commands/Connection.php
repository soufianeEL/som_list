<?php
/**
 * Created by PhpStorm.
 * User: soufiane
 * Date: 25/05/2015
 * Time: 17:44
 */

namespace app\Commands;
define('NEWLINE' ,"\n");

class Connection
{
    public $HOST;
    public $PORT = 7543;
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
       // echo "from open -- ";
        $this->socket_context = function_exists('stream_socket_client');
        if ($this->socket_context){ // if true : function exist
            $this->socket_context = stream_context_create(array());
            $this->stream = @stream_socket_client($this->HOST . ":" . $this->PORT,
                $errno, $errstr, $this->timeout, STREAM_CLIENT_CONNECT, $this->socket_context);
            return true;
        }
        else {
            echo "Connection: stream_socket_client not available, falling back to fsockopen";
            return false;
        }
    }

    function command($cmd) {
        fwrite($this->stream, $cmd . NEWLINE) ;
    }

    function Send($mail){
        //echo "from send -- ";

        if($this->stream == null){
            echo ' => connnnn == null';
            return false;
        }

        $this->command("HELO sure.somsales.com");
        $this->command("MAIL FROM: <$mail->MAIL_FROM>");
        $this->command("RCPT TO: <$mail->RCPT_TO>");
        $this->command("DATA");
        $this->command($mail->DATA['headers']);
        $this->command(NEWLINE);
        $this->command($mail->DATA['body']);
        $this->command(".");
        //$this->response .= stream_get_contents($this->connection) . '<br>';
    }


    function close(){
        echo "from close -- ";

        $this->command('QUIT');
        //$this->response = stream_get_contents($this->stream);
        echo stream_get_contents($this->stream);

        if (is_resource($this->stream)){
            fclose($this->stream);
            $this->stream = null;
        }
    }
}