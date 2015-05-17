<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller {


	public function index()
	{
		$campaigns= Campaign::all();
        return view('campaigns.index', compact('campaigns'));
	}

    public function start()
    {
        echo 'ok';
    }

	public function create()
	{
		//
	}


	public function store()
	{
		//
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
