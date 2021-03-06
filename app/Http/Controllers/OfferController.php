<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OfferController extends Controller {

    protected $rules = [
        'name' => ['required', 'min:3'],
        'code' => ['required'],
    ];


	public function index()
	{
        $offers = Offer::all();
        return view('offers.index', compact('offers'));
	}

    public function show(Offer $offer)
    {
        //dd($offer);
        //$offer.=$offer->with('subjects','creatives');
        return view('offers.show', compact('offer'));
    }

    /*public function prepare(Offer $offer)
    {
        return view('offers.prepare', compact('offer'));
    }*/

	public function create(Request $request)
	{
        if($request->ajax())
		    return view('offers._create');
	}

    public function edit(Request $request, Offer $offer)
    {
        if($request->ajax())
            return view('offers._edit',compact('offer'));
    }

    public function store(Request $request)
	{
        $this->validate($request, $this->rules);
        $input = Input::all();
        $offer = Offer::create($input);
        return Redirect::route('offers.show', $offer)->with('message','Offer created');

    }

	public function update(Offer $offer,Request $request)
	{
		$this->validate($request, $this->rules);
        $input = array_except(Input::all(),'_method');
        $offer->update($input);
        return Redirect::route('offers.show', $offer)->with('message','Offer updated');
	}

	public function destroy(Offer $offer)
	{
		$offer->delete();
        return Redirect::route('offers.index')->with('message','Offer deleted');
	}

}
