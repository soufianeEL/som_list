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

	public function create(Offer $offer)
	{
        return view('prepared_offers.create', compact('offer'));
	}


	public function store()
	{
		//return view('campaigns.start');
        $input = Input::all();
        //$prepared_offer = PreparedOffer::create($input);
        $prepared_offer = PreparedOffer::find(10);
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
