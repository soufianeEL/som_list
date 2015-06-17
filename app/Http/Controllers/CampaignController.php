<?php namespace App\Http\Controllers;

use App\Commands\Nohup;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Queue as Myqueue;

use App\Models\AccountList;
use App\Models\Campaign;
use App\Models\Creative;
use App\Models\FromLine;
use App\Models\Ip;
use App\Models\PreparedOffer;
use App\Models\Server;
use App\Models\Subject;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redirect;


class CampaignController extends Controller {

    protected $rules = [
        'vmta'  => ['required'],
        'lists' => ['required'],
        //'msg_conn' => ['required','digits_between:100,100000'],
//        'code' => ['required'],
    ];

	public function index()
	{
        // to fix user problem later
		//$campaigns= Campaign::with('lists')->with('ips')->get();
		$campaigns= Campaign::with('lists')->get();
        return view('campaigns.index', compact('campaigns'));
	}

    public function start(PreparedOffer $prepared_offer)
    {
        $var = $prepared_offer->info();
        $select = $this->select_ips();
        $lists = AccountList::all(['id','name']);

        return view('campaigns.start', compact('var','select','lists'));
    }

    public function show(Campaign $campaign, PreparedOffer $prepared_offer)
    {
        $var = $prepared_offer->info();
        $select = $select = $this->select_ips();
        $lists = AccountList::all(['id','name']);

        /// to optimize later
        $c_ips = [];
        foreach($campaign->ips as $ip){
            $c_ips[] = $ip->id;
        }
        /// to optimize later
        $c_lists = [];
        foreach($campaign->lists as $list){
            $c_lists[] = $list->id;
        }

        return view('campaigns.show', compact('campaign','var','select','c_ips','c_lists','lists'));
    }


	public function store(Request $request)
	{
        $this->validate($request, $this->rules);

        $input = Input::all();

        $campaign = new Campaign();
        $campaign->name = $input["offre"] . '__' . date('Y-m-d-h:i:s');
        $campaign->status = 'trashed';
        $campaign->prepared_offer_id = $input["prepared_offer_id"];
        $tmp = $input["prepared_offer_id"];
        $campaign->save();
        $campaign->ips()->sync($input['vmta']);
        $campaign->lists()->sync($input['lists']);
        $campaign->messages()->create(['name' => $campaign->id.'_'.$campaign->name,'headers' => Input::get("headers"),'body' => Input::get("message")]);

        $this->send($campaign);
        return Redirect::route('campaigns.index')->with('message','Campaign sent successfully');
        //return Redirect::route('campaigns.show', [$campaign->id, $campaign->prepared_offer_id])->with('message','Campaign sent successfully');
        //return redirect()->back()->with('message', 'Campaign sent successfully');
	}

    public function update(Request $request, Campaign $campaign)
    {
        $this->send($campaign);
        return Redirect::route('campaigns.index')->with('message','Campaign sent successfully');
        //return redirect()->back()->with('message', 'Campaign sent successfully');
    }

    public function edit($id)
	{
	}

	public function destroy($id)
	{
	}

    public function select_ips(){
        $select = [];
        foreach( Server::with('ips')->where('active', 1)->get(['id','name']) as $server){
            foreach($server->ips as $ip){
                //if ip active
                $select[$server->name][$ip->id] = $ip->ip;
            }
        }
        return $select;
    }

    public function send(Campaign $campaign)
    {
        $ips = Input::get("vmta");
        $vmta = "0,1,2,3";
        $fraction = Input::get("msg_conn");
        $msg_conn = 1000;
        $msg_ip = Input::get("msg_vmta");
        $msg_vmta = 500;
        $subject = Input::get("subject");
        $from = Input::get("from");

        $from2 = 'test@email';
        //dump($ips);
        $headers = Input::get("headers");
        $message = trim(Input::get("message"));

        $campaign->send($vmta, $from, $subject, $headers, $message, $msg_vmta, $msg_conn);

    }

    public function is_sent(Campaign $campaign){
        return $campaign->status;
    }

    public function status(){
        $ids = Input::get("ids");
        //dump($ids);
        $campaigns_in_progress = Campaign::where('status','in progress')->get(['id'])->toArray();

        $return = array_map(function($n){return $n['id'];},$campaigns_in_progress);
        return $return;
    }

    public function pause(Campaign $campaign){
        $campaign->pause();
    }

    public function resume(Campaign $campaign){

    }

}

///////////////
//////////////
//////////////
//
//class SendCampaign {
//    public $vmta = array('MTA-146.247.24.68-gmail','MTA-146.247.24.69-gmail','MTA-146.247.24.91-gmail','MTA-146.247.24.92-gmail');
//
//    public $ips;
//    public $from;
//    public $subject;
//    public $headers;
//    public $message;
//    public $msg_vmta;
//    public $msg_conn;
//
//    public $nbr_vmta ;
//
//
//    public function __construct($ips, $from, $subject, $headers, $message, $msg_vmta, $msg_conn )
//    {
//        $this->ips = explode(',', trim($ips));
//        $this->from = trim($from);
//        $this->subject = trim($subject);
//        $this->headers = trim($headers);
//        $this->message = trim($message);
//        $this->msg_vmta = trim($msg_vmta);
//        $this->msg_conn = trim($msg_conn);
//
//        $this->nbr_vmta = count($ips);
//    }
//
//    public function run()
//    {
//
//        $handle = fopen("data.csv", "r") or die("Couldn't open file (data)");
//        $id = 0;
//        $connection = new Connection('somsales.com',7543);
//
//        if ($handle) {
//            $connection->open(); //helo !!
//            //$connection->helo();
//            while ($line = fgets($handle)) {
//                $elemt = explode("|",$line);
//                $email = $elemt[1];
//
//                $tmp_mail = new Mail();
//                $tmp_mail->RCPT_TO = $email;
//                $tmp_mail->MAIL_FROM = $this->from;
//
//                $i = $this->msg_vmta($id,$this->msg_vmta,$this->nbr_vmta);
//                $id_vmta = $this->ips[$i];
//
//                $tmp_mail->prepare($this->vmta[$id_vmta], $this->subject, $this->message , $this->headers);
//
//                if($id % $this->msg_conn == 0 && $id != 0){
//                    $connection->close();
//                    $connection->open();
//                    //$connection->helo();
//                }
//
//                $connection->send($tmp_mail) ;
//                $id++;
//            }
//            fclose($handle);
//            $connection->close();
//        }
//        echo "nbr line = {$id} \n";
//
//    }
//
//    public function msg_vmta($compteur, $msg_vmta, $nbr_vmta){
//        $result = (int) ($compteur / $msg_vmta);
//
//        if ($result >= $msg_vmta && $msg_vmta > $nbr_vmta) {
//            $result = $result % $msg_vmta ;
//        }
//        if ($compteur >= $msg_vmta * $nbr_vmta) {
//            $tmp = $compteur % ($msg_vmta * $nbr_vmta);
//            $result = (int) ($tmp / $msg_vmta);
//        }
//        return $result;
//    }
//
//}
//
//class Connection
//{
//    public $HOST;
//    public $PORT = 25;
//    public $timeout = 30;
//    public $socket_context;
//    public $stream; //connection
//    public $response = '';
//
//    function __construct($host,$port)
//    {
//        $this->HOST = $host;
//        $this->PORT = $port;
//    }
//
//    function open(){
//        echo "from open -- ";
//
//        $this->socket_context = stream_context_create(array());
//        $this->stream = stream_socket_client($this->HOST . ":" . $this->PORT,
//            $errno, $errstr, $this->timeout, STREAM_CLIENT_CONNECT, $this->socket_context);
//        if (!$this->stream) {
//            echo "$errstr ($errno) <br/>\n";
//            return flase;
//        }
//        return true;
//    }
//
//    function command($cmd) {
//        fwrite($this->stream, $cmd . NEWLINE) ;
//    }
//    function helo(){
//        if($this->stream == null){
//            echo ' => conn == null';
//            return false;
//        }
//        echo 'from helo';
//        $this->command("HELO somsales.com");
//    }
//
//    function Send($mail){
//        //echo "from send -- ";
//        if($this->stream == null){
//            echo ' => conn == null';
//            return false;
//        }
//        //$this->command("HELO sure.somsales.com");
//        $this->command("MAIL FROM: <$mail->MAIL_FROM>");
//        $this->command("RCPT TO: <$mail->RCPT_TO>");
//        $this->command("DATA");
//        $this->command($mail->DATA['headers']);
//        $this->command(NEWLINE);
//        $this->command($mail->DATA['body']);
//        $this->command(".");
//    }
//
//
//    function close(){
////        echo "from close -- ";
//
//        if($this->stream == null){
//            echo ' => connnnn == null';
//            return false;
//        }
//        $this->command('QUIT');
//        $this->response = stream_get_contents($this->stream);
//        //echo stream_get_contents($this->stream);
//
//        if (is_resource($this->stream)){
//            fclose($this->stream);
//            $this->stream = null;
//        }
//    }
//}
//
//class Mail {
//    public $RCPT_TO;
//    public $MAIL_FROM;
//    public $HOST;
//    public $PORT = 7543;
//    public $DATA = array('headers' => '', 'body' => '' );
//
//    public $connection;
//    public $timeout = 30;
//    public $socket_context;
//    public $response = '';
//
//    function prepare($vmta, $subject, $msg, $headers){
//        //$this->RCPT_TO = $to;$this->addheader('To',$to);
//        $this->DATA['headers'] = $headers . NEWLINE;
//        $this->addheader('x-virtual-mta', $vmta);
//        $this->addheader('Subject',$subject);
//        $this->addheader('To',$this->RCPT_TO);
//        $this->addheader('MIME-Version','1.0');
//        $this->DATA['body'] = $msg;
//    }
//
//    function set_params($host, $port, $from) {
//        $this->HOST = $host;
//        $this->PORT = $port;
//        $this->MAIL_FROM = $from;
//    }
//
//    function addheader($name, $value){
//        $this->DATA['headers'] .=  $name . ': ' . $value . NEWLINE;
//    }
//
//}