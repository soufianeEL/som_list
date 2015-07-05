<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Server;
use Input;
use App\Models\Ip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IpController extends Controller {

    protected $rules = [
        'domain' => ['required', 'min:3'],
    ];

	public function index()
	{
		$ips = Ip::paginate(10);
        return view('ips.index',compact('ips'));
	}

	public function create(Server $server)
	{
		return view('ips._create', compact('server'));
	}

	public function store(Server $server, Request $request)
    {
        $this->validate($request, $this->rules);
        $input = Input::all();

        $server->ips()->create($input);
        return Redirect::route('servers.show', $server)->with('message','Server updated (ip created)');
	}

	public function show(Server $server,Ip $ip)
	{
		return view('ips._show', compact('server','ip'));
	}


	public function edit(Server $server,Ip $ip)
    {
        return view('ips._edit', compact('server', 'ip'));
	}


	public function update(Server $server,Ip $ip)
    {
        $input = array_except(Input::all(), '_method');
        $ip->update($input);

        return Redirect::route('servers.show', $server)->with('message','Server updated (ip edited)');
	}


	public function destroy(Server $server, Ip $ip)
	{
        $ip->delete();
        return Redirect::route('servers.show', $server)->with('message','Server updated (ip deleted)');
	}

}
