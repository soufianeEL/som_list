<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\Subject;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Models\Offer;

use Illuminate\Http\Request;

class SubjectController extends Controller {

	public function index()
	{
		//
	}

    public function show($id)
    {
        //
    }

    public function create(Request $request,Offer $offer)
    {
        if($request->ajax())
            return view('subjects._create', compact('offer'));
    }
    public function edit(Offer $offer,Subject $subject)
    {
        return view('subjects.edit', compact('offer', 'subject'));
    }


	public function store(Offer $offer,Request $request)
	{
		$input = Input::all();

        $offer->subjects()->create($input);
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject created)');
	}

	public function update(Offer $offer,Subject $subject)
	{
        $input = array_except(Input::all(), '_method');
        $subject->update($input);

        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject updated)');
	}

	public function destroy(Offer $offer, Subject $subject)
	{
		$subject->delete();
        return Redirect::route('offers.show', $offer)->with('message','Offer updated (subject deleted)');
	}

}
