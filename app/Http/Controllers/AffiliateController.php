<?php namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Input;
use Illuminate\Http\Request;

class AffiliateController extends Controller {

    protected $rules = [
        'name' => ['required', 'min:3'],
        'code' => ['required'],
    ];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $affiliates = Affiliate::all();
        return view('affiliates.index', compact('affiliates'));
	}

    public function getOffers(Affiliate $affiliate){

        $offers = $affiliate->offers();
        return view('offers.index', compact('offers'));
    }

    public function create(Request $request)
	{
        if($request->ajax())
            //return View::make('affiliates._create')->render();
            return view('affiliates._create');
        else
            return view('affiliates.create');
	}

    public function edit(Request $request,Affiliate $affiliate)
    {
        if($request->ajax()){
            return view('affiliates._edit',compact('affiliate'));
        }
        else
            return view('affiliates.edit',compact('affiliate'));
    }


    public function store(Request $request)
	{
        $this->validate($request, $this->rules);

        $input = Input::all();
        Affiliate::create( $input );
        return Redirect::route('affiliates.index')->with('message', 'Affiliate created');
	}


    public function update(Affiliate $affiliate, Request $request)
    {
        $this->validate($request, $this->rules);
        $input = array_except(Input::all(),'_method');
        $affiliate->update($input);
        // faut faire aff.show au lieu aff.index
        return Redirect::route('affiliates.index')->with('message', 'Affiliate updated.');
    }

	public function destroy(Affiliate $affiliate)
	{
        $affiliate->delete();
        return Redirect::route('affiliates.index')->with('message', 'Affiliate deleted.');
	}

    public function show(Affiliate $affiliate)
    {
        return view('affiliates.show', compact('affiliate'));
    }
}
