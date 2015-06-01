<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\FromLine;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class FromLineController extends Controller {


	public function index()
	{
		//
	}


	public function create(Request $request,Offer $offer)
    {
        if($request->ajax())
            return view('from_lines._create', compact('offer'));
    }

	public function store(Request $request,Offer $offer)
    {
        $input = Input::all();

        $offer->from_lines()->create($input);
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (from line created)');
	}

	public function show($id)
	{
		//
	}

	public function edit(Request $request, Offer $offer, FromLine $from_line)
    {
        if($request->ajax())
            return view('from_lines._edit', compact('offer', 'from_line'));
	}


	public function update(Offer $offer,FromLine $from_line)
    {
        $input = array_except(Input::all(), '_method');
        $from_line->update($input);

        return Redirect::route('offers.show', $offer)->with('message','Offer updated (from_line updated)');
	}


	public function destroy($id)
	{
		//
	}

}
