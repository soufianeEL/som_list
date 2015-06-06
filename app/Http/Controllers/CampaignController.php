<?php namespace App\Http\Controllers;

use App\Commands\SendCampaign;
use App\Commands\TestCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

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
        $var = [
            'prepared_offre' => $prepared_offer->id,
            'offre' => $prepared_offer->offer->name,
            'subject' => $prepared_offer->subject()->name,
            'from' => $prepared_offer->from()->from,
            'creative' => $prepared_offer->creative()->name
        ];

        $select = array();
//        $servers = Server::where('active', 1)->get(['id','name']);
//        foreach( $servers as $server){
//            foreach($server->ips as $ip){
//                $select[$server->name][$ip->id] = $ip->ip;
//            }
//        }

        foreach( Server::with('ips')->where('active', 1)->get(['id','name']) as $server){
            foreach($server->ips as $ip){
                //if ip active
                $select[$server->name][$ip->id] = $ip->ip;
            }
        }

        $lists = AccountList::all(['id','name']);

        return view('campaigns.start', compact('var','select','lists'));
    }


	public function store(Request $request)
	{
        $this->validate($request, $this->rules);

        $input = Input::all();

        $campaign = new Campaign();
        $campaign->name = $input["offre"] . '__' . date('Y-m-d-h:i:s');
        $campaign->status = 'trashed';
        $campaign->prepared_offer_id = $input["prepared_offer_id"];

        $campaign->save();
        $campaign->ips()->sync($input['vmta']);
        $campaign->lists()->sync($input['lists']);
        $campaign->messages()->create(['name' => $campaign->id.'_'.$campaign->name,'headers' => Input::get("headers"),'body' => Input::get("message")]);
        echo "saved oook <br>";

        $this->send();
        return redirect()->back()->with('message', 'Campaign sent successfully');
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
    }

	public function show(Campaign $campaign, PreparedOffer $prepared_offer)
	{
        $var = [
            'prepared_offre' => $prepared_offer->id,
            'offre' => $prepared_offer->offer->name,
            'subject' => $prepared_offer->subject()->name,
            'from' => $prepared_offer->from()->from,
            'creative' => $prepared_offer->creative()->name
        ];

        $select = [];
        foreach( Server::with('ips')->where('active', 1)->get(['id','name']) as $server){
            foreach($server->ips as $ip){
                //if ip active
                $select[$server->name][$ip->id] = $ip->ip;
            }
        }
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

        $lists = AccountList::all(['id','name']);
        return view('campaigns.show', compact('var','select','c_ips','c_lists','lists'));
	}

    /**
     * @param $id
     */
    public function edit($id)
	{
        Queue::push(new TestCommand());
        echo "ook - ".date('Y-m-d-h:i:s');
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
