<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Campaign;
use App\Models\Creative;
use App\Models\FromLine;
use App\Models\PreparedOffer;
use App\Models\Server;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        //dd($servers[0]->ips);
        return view('campaigns.start', compact('var'));
    }

	public function create()
	{

	}


	public function store()
	{
        $input = Input::all();

        $campaign = new Campaign();
        $campaign->name = $input["offre"] . '-' . $input["list"];
        $campaign->status = 'just created';
        $campaign->prepared_offer_id = $input["prepared_offer_id"];

        $campaign->save();
        echo "saved oook";
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
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
