<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\staff;
use App\schedule;

class StaffController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        
        $staff = staff::where('user_id',auth()->user()->id)->paginate(10);

        return view('staff.index', compact('staff'));

    }

    public function create()
    {
        
        return view('staff.create');

    }


    public function store(Request $request)
    {
        
        $this->validate(request(), [

            'staffname' => 'required',

        ]);

        $staff = new staff;

        $staff->name = request('staffname');
        $staff->user_id = auth()->user()->id;
        $staff->colour = request('staffcolour');

        $staff->save();

        return redirect("/staff");

    }    


    public function destroy($id)
    {
        
        staff::where('user_id',auth()->user()->id)->where('id',$id)->delete();

        
        // TODO Do this a better way
        
        schedule::where('user_id',auth()->user()->id)->where('staff_id',$id)->update(['staff_id' => 0]);

        return redirect("/staff");        

    }    

}

