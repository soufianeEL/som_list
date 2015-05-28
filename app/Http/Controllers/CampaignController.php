<?php namespace App\Http\Controllers;

use App\Commands\SendCampaign;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Campaign;
use App\Models\Creative;
use App\Models\FromLine;
use App\Models\Ip;
use App\Models\PreparedOffer;
use App\Models\Server;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class CampaignController extends Controller {


	public function index()
	{
		$campaigns= Campaign::all();
        return view('campaigns.index', compact('campaigns'));
	}

    public function start(PreparedOffer $prepared_offer)
    {
        $var = [
            'prepared_offre' => $prepared_offer->id,
            'offre' => $prepared_offer->offer->name,
            'subject' => Subject::find($prepared_offer->subject_id)->name,
            'from' => FromLine::find($prepared_offer->from_line_id)->from,
            'creative' => Creative::find($prepared_offer->creative_id)->name
        ];
        $servers = Server::where('active', 1)->get();
        //$ips = Ip::where('server_id', 3)->get(array('id','ip'));;
        $select = array();
        foreach( $servers as $server){
            foreach($server->ips as $ip){
                $select[$server->name][$ip->id] = $ip->ip;
            }
        }

//        foreach (Book::with('author')->get() as $book)
//        {
//            echo $book->author->name;
//        }

        return view('campaigns.start', compact('var','select'));
    }


	public function store()
	{
        $input = Input::all();

        $campaign = new Campaign();
        $campaign->name = $input["offre"] . '-' . $input["list"];
        $campaign->status = 'trashed';
        $campaign->prepared_offer_id = $input["prepared_offer_id"];

        //$campaign->save();
        //$campaign->ips()->sync($input['vmta']);

        echo "saved oook";

        $this->send();
	}

    public function send()
    {

        //dump(Input::all());
        $ips = Input::get("vmta");
        $vmta = "0,1,2,3";
        $fraction = Input::get("msg_conn");
        $msg_conn = 500;
        $msg_ip = Input::get("msg_vmta");
        $msg_vmta = 500;
        $subject = Input::get("subject");
        $from = Input::get("from");

        $from2 = 'test@email';
        //dump($ips);
        $headers = Input::get("headers");
        $message = Input::get("message");

        //Queue::push(new SendCampaign($vmta, $from, $subject, $headers, $message, $msg_vmta, $msg_conn ));

        echo 'send ook';
    }

	public function show($id)
	{
		//
	}

	public function edit()
	{
        
	}


	public function update($id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}

}
