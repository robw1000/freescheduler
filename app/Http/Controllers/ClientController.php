<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\schedule;

class ClientController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $client = client::where('user_id',auth()->user()->id)->paginate(10);

        return view('client.index', compact('client'));

    }

    public function create()
    {
        
        return view('client.create');

    }


    public function store(Request $request)
    {
        
        $this->validate(request(), [

            'clientname' => 'required',

        ]);

        $client = new client;

        $client->name = request('clientname');
        $client->user_id = auth()->user()->id;

        $client->save();

        return redirect("/client");

    }    


    public function destroy($id)
    {
        
        client::where('user_id',auth()->user()->id)->where('id',$id)->delete();

        schedule::where('user_id',auth()->user()->id)->where('client_id',$id)->delete();

        return redirect("/client");        

    }    

}
