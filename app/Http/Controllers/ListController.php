<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AccountList;
use Illuminate\Http\Request;

class ListController extends Controller {


	public function index()
	{
        $lists = AccountList::all();
        return view('lists.index', compact('lists'));
	}

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

	public function create()
	{
		//
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
