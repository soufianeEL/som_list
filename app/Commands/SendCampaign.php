<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
//define('NEWLINE' ,"\n");

class SendCampaign extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

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
        $this->ips = explode(',', $ips);
        $this->from = $from;
        $this->subject = $subject;
        $this->headers = trim($headers);
        $this->message = $message;
        $this->msg_vmta = $msg_vmta;
        $this->msg_conn = $msg_conn;

        $this->nbr_vmta = count($ips);
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{

        //$event = $this->event;

        if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
        }
        $handle = fopen("data.txt.save", "r") or die("Couldn't open file (data)");
        $id = 0;
        $connection = new Connection('somsales.com',7543);

        if ($handle) {
            $connection->open();
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
                }

                $connection->send($tmp_mail) ;

                $id++;
            }
            fclose($handle);
            $connection->close();
        }


        echo "nbr line = {$id} \n";

        $time_taken = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
        echo "Process Time: {$time_taken}" .NEWLINE;

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
