<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Offer;
use App\Models\PreparedOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PreparedOfferController extends Controller {


	public function index()
	{
		$p_offers = PreparedOffer::all();
        return view('prepared_offers.index', compact('p_offers'));
	}

	public function create($id)
	{
        $offer = Offer::with(['subjects','from_lines','creatives'])->find($id,['id','name']);
        return view('prepared_offers._create', compact('offer'));
	}


	public function store()
	{
        $input = Input::all();
        $prepared_offer = PreparedOffer::create($input);

        return Redirect::route('campaigns.start', compact('prepared_offer'))->with('message','Offer prepared');
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
