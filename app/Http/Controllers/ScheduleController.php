<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\client;
use App\schedule;
use App\staff;


class ScheduleController extends Controller
{

    public function index($cid)

    {    

		$client = client::where('user_id',auth()->user()->id)->where('id',$cid)->first();

        $schedule = schedule::where('client_id',$cid)
        	->where('user_id',auth()->user()->id)
            ->orderby('time')
            ->get();

//This is a Mysql function
//->orderByRaw('FIELD(day, "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY")')

		return view('schedule.index', compact('schedule','client'));

	}
    
    public function create($cid) 
    
    {
        $daysofweek = config('free-scheduler.daysofweek');
        $apt_durations = config('free-scheduler.durations');

        //Staff to allocate to appointment

        $staff = staff::where('user_id',auth()->user()->id)->pluck('name','id');

        return view('schedule.create')
            ->with(compact('daysofweek','apt_durations','staff'))
            ->with('cid',$cid);
        
    }


    public function store(Request $request)
    {
        
        $this->validate(request(), [

            'day' => 'required',
            'time' => 'required',
            'duration' => 'required'

        ]);

        //TODO Check the user is allowed to store schedules to the client

        $cid = request('client_id');

        $schedule = new schedule;

        $schedule->client_id = request('client_id');
        $schedule->user_id = auth()->user()->id;
        $schedule->day = request('day');
        $schedule->time = request('time');
        $schedule->duration = request('duration');
        $schedule->staff_id = request('staff_id');

        $schedule->save();

        return redirect("/schedule/$cid");

    }  


    public function destroy($id)
    {
        
        schedule::where('user_id',auth()->user()->id)->where('id',$id)->delete();

        // TO DO Remove staff from schedule - change to blank or zero

        // Get client id and return back to the schedule list for that client.
        return redirect("/schedule");

    }    


    public function calendar() {

        $events = array();
        
        $apts = array();

        $day_of_week = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

        foreach($day_of_week as $day) {

            $thisdate = date("Y-m-d",strtotime("$day next week"));

            $data = schedule::where('user_id',auth()->user()->id)->where('day',$day)->orderby('time')->get();

            foreach ($data as $row) {

                $apts[] = array("apdate" => date('Y-m-d H:i:s',strtotime($thisdate . $row["day"] . $row["time"])), "client_id" => $row["client_id"], "duration" => $row["duration"], "id" => $row["id"], "colour" => $row["staff"]->colour, "client_name" => $row["client"]->name, "staff_name" => $row["staff"]->name) ;

            }

        }

        foreach($apts as $key) {

            $start = $key["apdate"];

            $duration = round($key["duration"]);

            $interval = "+" . $duration . " minutes";

            $end = date("Y-m-d H:i:s",strtotime($interval, strtotime($start)));

            $e = array();

            $e["id"] = $key["id"];
        
            $e["title"] = $key["client_name"] . ' with ' . $key["staff_name"];

            $e["start"] = $start;

            $e["end"] = $end;

            $e["backgroundColor"] = $key["colour"] ;

            array_push($events, $e);

        }

        return view('schedule.planner', compact('events'))->with('defaultdate',date('Y-m-d',strtotime('Next Monday')));
        
    }


    public function resources() {

        $staff = staff::selectRaw("id,name as title")->where('user_id',auth()->user()->id)->get()->toArray();

        $events = array();
        
        $apts = array();

        $day_of_week = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

        foreach($day_of_week as $day) {

            $thisdate = date("Y-m-d",strtotime("$day next week"));

            $data = schedule::where('user_id',auth()->user()->id)->where('day',$day)->orderby('time')->get();

            foreach ($data as $row) {

                $apts[] = array("apdate" => date('Y-m-d H:i:s',strtotime($thisdate . $row["day"] . $row["time"])), "client_id" => $row["client_id"], "duration" => $row["duration"], "id" => $row["id"], "staff_id" => $row["staff_id"], "colour" => $row["staff"]->colour, "client_name" => $row["client"]->name, "staff_name" => $row["staff"]->name) ;

            }

        }

        foreach($apts as $key) {

            $start = $key["apdate"];

            $duration = round($key["duration"]);

            $interval = "+" . $duration . " minutes";

            $end = date("Y-m-d H:i:s",strtotime($interval, strtotime($start)));

            $e = array();

            $e["id"] = $key["id"];
        
            $e["title"] = $key["client_name"] . ' with ' . $key["staff_name"];

            $e["start"] = $start;

            $e["end"] = $end;

            $e["backgroundColor"] = $key["colour"] ;

            $e["resourceId"] = $key["staff_id"] ;
            
            $e["resourceEditable"] = true;

            array_push($events, $e);

        }

        return view('schedule.resources', compact('events','staff'))->with('defaultdate',date('Y-m-d',strtotime('Next Monday')));
        
    }


// WORK ON: how you want the drag and drop update to work on the resource (and calendar?) views.

}
