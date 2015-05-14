<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Offer;
use Illuminate\Http\Request;

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
        return view('offers.show', compact('offer'));
    }

	public function create()
	{
		return view('offers.create');
	}

    public function edit(Offer $offer)
    {
        return view('offers.edit',compact('offer'));
    }

    public function store()
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
