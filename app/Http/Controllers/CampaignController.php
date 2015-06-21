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
        //'msg_conn' => ['required','digits_between:100,100000'],  //        'code' => ['required'],
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
        $this->validate($request, $this->rules);

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
        $msg_conn = 500;
        $msg_ip = Input::get("msg_vmta");
        $msg_vmta = 100;
        $subject = Input::get("subject");
        $from = Input::get("from");

        $from2 = 'test@email';
        //dump($ips);
        $headers = Input::get("headers");
        $message = trim(Input::get("message"));

        $campaign->send($vmta, $from, $subject, $headers, $message, $msg_vmta, $msg_conn);

    }

    public function get_status(Campaign $campaign){
        return $campaign->status;
    }

    public function status(){
        $ids = Input::get("ids");
        //dump($ids);
        $campaigns_in_progress = Campaign::where('status','in progress')->get(['id'])->toArray();
        $return = array_map(function($n){return $n['id'];},$campaigns_in_progress);
        return $return;
    }

    public function pause($id){
        $campaign = Campaign::find($id);
        if($campaign)
            $campaign->pause_job();
    }

    public function resume($id){
        $campaign = Campaign::find($id);
        if($campaign)
            $campaign->resume_job();
    }

}
