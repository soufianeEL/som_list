<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Input;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller {

    protected $rules = [
        'name' => ['required', 'min:3'],
    ];

	public function index()
	{
		$servers = Server::all();

        return view('servers.index',compact('servers'));
	}

    public function show(Server $server)
    {
        return view('servers.show', compact('server'));
    }

    public function edit(Server $server)
    {
        return view('servers._edit', compact('server'));
    }

	public function create()
	{
		return view('servers._create');
	}

	public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $input = Input::all();
        //dd($input);

        Server::create( $input );

        return Redirect::route('servers.index')->with('message', 'Server created');
	}

	public function update(Server $server, Request $request)
	{
        $this->validate($request, $this->rules);
        $input = array_except(Input::all(),'_method');
        $server->update($input);
        // faut faire aff.show au lieu aff.index
        return Redirect::route('servers.index')->with('message', 'Server updated.');
	}

	public function destroy(Server $server)
	{
        $server->ips()->delete();
        $server->delete();
        return Redirect::route('servers.index')->with('message', 'Server deleted.');
	}

}
