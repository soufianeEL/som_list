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
        'delay' => ['required'],  //        'code' => ['required'],
        'msg_vmta' => ['required','integer','between:100,3000'],  //        'code' => ['required'],
    ];

    protected $message = [
        'msg_vmta.between' => 'The Msg/Ip must be between :min -> :max.',
        'delay.between' => 'The Msg/Connexion must be between :min -> :max.',
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
        $select = $this->select_ips();
        $lists = AccountList::all(['id','name']);

        $params = $campaign->lastParam();
        $message = $campaign->lastMessage();

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

        return view('campaigns.show', compact('campaign','var','select','c_ips','c_lists','lists','params','message'));
    }


	public function store(Request $request)
	{
        $this->validate($request, $this->rules, $this->message);

        $campaign = $this->setCampaign();
        $campaign = $this->setCampaignRelations($campaign);
        $this->send($campaign);
        return Redirect::route('campaigns.index')->with('message','Campaign sent successfully');
	}

    public function setCampaign(){

        $campaign = new Campaign();
        $campaign->name = str_replace(' ','_',Input::get("offre")) . '__' . date('Y-m-d-h:i:s');
        $campaign->status = 'trashed';
        $campaign->prepared_offer_id = Input::get("prepared_offer_id");
        $campaign->save();
        return $campaign;
    }

    public function setCampaignRelations(Campaign $campaign){

        $ips = array_map(function($n){
                $tmp = explode('-', $n);
                return $tmp[1];
            },Input::get("vmta"));

        $campaign->ips()->sync($ips);
        $campaign->lists()->sync(Input::get("lists"));
        $campaign->messages()->create([
            'name' => '',
            'headers' => Input::get("headers"),
            'body' => Input::get("message")
        ]);
        $campaign->params()->create([
            'fraction' => Input::get("fraction"),
            'rotation' => Input::get("msg_vmta"),
            'delay' => Input::get("delay"),
            'seed' => '',
            'lists' => implode(',',Input::get("lists")),
            'ips' => implode(',',Input::get("vmta")),
        ]);
        return $campaign;
    }

    public function update(Request $request, Campaign $campaign)
    {

        $this->validate($request, $this->rules, $this->message);

        $campaign = $this->setCampaignRelations($campaign);
        $this->send($campaign);
        return Redirect::route('campaigns.index')->with('message','Campaign updated & sent successfully');
    }

    public function edit($id)
	{
	}

	public function destroy($id)
	{
	}

    public function send(Campaign $campaign)
    {
        $ips = implode(',',Input::get("vmta"));
        $vmta = "0,1,2,3";
        $msg_conn = 500;
        $fraction = Input::get("fraction");
        $delay = Input::get("delay");
        $msg_vmta = $campaign->lastParam()->rotation;
        $subject = $campaign->subject()->name;
        $from = $campaign->from()->from;

        $headers = $campaign->lastMessage()->headers;
        $message = $campaign->lastMessage()->body;

        $campaign->send($fraction, $ips, $from, $subject, $headers, $message, $msg_vmta, $delay);

    }

    public function select_ips(){
        $select = [];
        foreach( Server::with('ips')->where('active', 1)->get(['id','name']) as $server){
            foreach($server->ips as $ip){
                //if ip active
                $select[$server->id.'|'.$server->name][$ip->id] = $ip->ip;
            }
        }
        return $select;
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
