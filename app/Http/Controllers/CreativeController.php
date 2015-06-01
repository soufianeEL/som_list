<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\Creative;
use App\Models\Offer;
use Illuminate\Support\Facades\Redirect;
use Input;
use Illuminate\Http\Request;

class CreativeController extends Controller {

    protected $rules = [
        'name' => ['required', 'min:3'],
        'image' => ['required','mimes:jpeg,bmp,png'],
    ];

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

	public function create(Request $request,Offer $offer)
	{
        if($request->ajax())
		    return view('creatives._create',compact('offer'));
	}

	public function store(Offer $offer)
	{
        $input = Input::all();
        $offer->creatives()->create($input);
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject created)');
	}

	public function update(Offer $offer, Creative $creative, Request $request)
	{
        $this->validate($request, $this->rules);

        $file = Input::file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = $creative->id . '.' . $extension;
//        if (Input::hasFile('image')) { echo "ok"; }
//        else{ echo 'not ok ';}
        $input = array_except(Input::all(), '_method');
        $input['image'] = $fileName;
        $destinationPath = base_path() . '/public/creatives/'. $offer->id .'/' ;
        Input::file('image')->move($destinationPath , $fileName );

        $creative->update($input);
        //Session::flash('success', 'Upload successfully');
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (creative updated)');
	}

	public function destroy(Offer $offer, Creative $creative)
	{
        $creative->delete();
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject deleted)');
	}

}
