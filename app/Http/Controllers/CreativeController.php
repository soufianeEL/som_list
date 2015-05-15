<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Creative;
use App\Models\Offer;
use Illuminate\Support\Facades\Redirect;
use Input;
use Illuminate\Http\Request;

class CreativeController extends Controller {

	public function index()
	{
		//
	}

    public function show($id)
    {
        //
    }

    public function edit(Offer $offer,Creative $creative)
    {
        return view('creatives.edit',compact('offer','creative'));
    }

	public function create(Offer $offer)
	{
		return view('creatives.create',compact('offer'));
	}

	public function store(Offer $offer)
	{
        $input = Input::all();
        $offer->creatives()->create($input);
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject created)');
	}

	public function update(Offer $offer, Creative $creative)
	{
        $input = array_except(Input::all(), '_method');
        $creative->update($input);

        return Redirect::route('offers.show', $offer)->with('message','Offer updated (creative updated)');
	}

	public function destroy(Offer $offer, Creative $creative)
	{
        $creative->delete();
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject deleted)');
	}

}
