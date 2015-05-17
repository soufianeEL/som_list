<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PreparedOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PreparedOfferController extends Controller {


	public function index()
	{
		$p_offers = PreparedOffer::all();
        return view('prepared_offers.index', compact('p_offers'));
	}


	public function create()
	{
		//
	}


	public function store()
	{
		//return view('campaigns.start');
        return Redirect::route('campaigns.start');
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
