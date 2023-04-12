<?php

namespace App\Http\Controllers;
use Exception;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Section;
use App\Models\Location;
use App\Models\Shift;
use App\Models\Roster;
use Illuminate\Support\Facades\Mail;
use illuminate\Support\Facades\Auth;
use App\Mail\NotifyUsers;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {
        $users = User::all();
        $sections = Section::all();
        return view('admin.adminHome', compact('users','sections'));
    }


    //edit user admin status----------------------------------------------------
    public function edit()
    {
        $users = User::all();
        return view('admin.editUsers', compact('users'));
    }

    public function findUsers($search){
        if($search == 0){
            $users = User::all();
        }else{
            $users = User::where('last_name', 'LIKE', '%'.$search.'%')->get();
        }
        $user_array = [];
        foreach($users as $user){
            $prop_array = [];
            $prop_array['id'] = $user->id;
            $prop_array['first_name'] = $user->first_name;
            $prop_array['last_name'] = $user->last_name;
            $prop_array['email'] = $user->email;
            $prop_array['admin'] = $user->is_admin;
            $obj_array = [];
            $obj_array['user'] = $prop_array;
            array_push($user_array, $obj_array);
        }
        return json_encode($user_array); //<--laravel automatically translates this to json. json_encode() is not required here.
    }


    public function permissions($id)
    {
        $user = User::find($id);
        return view('admin.permissions', compact('user'));
    }

    public function editPermissions(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        if($request->input('is_admin') == null){
            $user->is_admin = 0;
        }else{
            $user->is_admin = $request->input('is_admin');
        }
        $user->email = $request->input('email');
        $user->save();

        return view('admin.permissions', compact('user'));
    }


    //edit schedules--------------------------------------------------------
    public function editSchedules()
    {
        $sectionLeadIds = [];
        $users = User::all();

        $sections = DB::table('sections')
                      ->join('volunteers', 'sections.volunteer_id', '=', 'volunteers.id')
                      ->select('sections.name', 'sections.description', 'sections.id', 'volunteers.first_name', 'volunteers.last_name', 'volunteers.id as volId')
                      ->get();

        foreach($sections as $section){
            array_push($sectionLeadIds, $section->volId);
        }

        $locations = DB::table('locations')
                        ->join('sections', 'locations.section_id', '=', 'sections.id')
                        ->select('locations.name', 'locations.description', 'locations.id', 'sections.name as section')
                        ->get();

        $volunteers = Volunteer::all();
                        
        return view('admin.editSchedules', compact('sections','users','locations','volunteers', 'sectionLeadIds'));
    }
    //ajax search schedules
    public function findShifts($search){
        $shifts = Shift::where('location_id',$search)->get();
        $shift_array = [];
        foreach($shifts as $shift){
            $found_array = [];
            $found_array['id'] = $shift->id;
            $found_array['current'] = $shift->current_volunteers;
            $found_array['max'] = $shift->max_volunteers;
            $found_array['start'] = $shift->start_time;
            $found_array['end'] = $shift->end_time;
            array_push($shift_array, $found_array);
        }
        return json_encode($shift_array);
    }

    //ajax search sections
    public function findLocations($search){
        $locations = Location::where('section_id',$search)->get();
        $location_array = []; 
        foreach($locations as $location){
            $found_array = [];
            $found_array['id'] = $location->id;
            $found_array['name'] = $location->name;
            array_push($location_array, $found_array);
        }
        return json_encode($location_array); 
    }

    //ajax search volunteers
    public function findVolunteers($search){
        $volunteers = Volunteer::where('last_name', 'LIKE', '%'.$search.'%')->get();
        $names_array = [];
        foreach($volunteers as $vol){
            $vol_array = [];
            $vol_array['firstname'] = $vol->first_name;
            $vol_array['lastname'] = $vol->last_name;
            $vol_array['Id'] = $vol->id;
            array_push($names_array, $vol_array);
        }
        return json_encode($names_array); //<--laravel automatically translates this array to json. json_encode() is not required here.
    }

    public function findVolunteers2($search)
    {
        if($search == 0){
            $volunteers = Volunteer::all();
        }else{
        $volunteers = Volunteer::where('last_name', 'LIKE', '%'.$search.'%')->get();
        }
        
        $sectionLeadIds = [];
        $sections = DB::table('sections')
                      ->join('volunteers', 'sections.volunteer_id', '=', 'volunteers.id')
                      ->select('sections.name', 'sections.description', 'sections.id', 'volunteers.first_name', 'volunteers.last_name', 'volunteers.id as volId')
                      ->get();

        foreach($sections as $section){
            array_push($sectionLeadIds, $section->volId);
        }

        return view('partial.displayvolunteers', compact('volunteers', 'sectionLeadIds'));
    }

    public function editVolSchedule($id)
    {
        $sections  = Section::all();
        $vol = Volunteer::find($id);
        $volShifts = DB::table('shifts')
            ->join('rosters', 'shifts.id', '=', 'rosters.shift_id')
            ->join('locations', 'locations.id', '=', 'shifts.location_id')
            ->join('sections', 'sections.id', '=', 'locations.section_id')
            ->where('rosters.volunteer_id', '=', $id)
            ->select( 'shifts.id','sections.name as section_name', 'locations.name as location_name', 'shifts.name', 'shifts.start_time', 'shifts.end_time')
            ->get();
        $allShifts = Shift::all();
        return view('admin.editVolSchedule', compact('vol', 'allShifts', 'volShifts','sections'));
    }

    public function editRoster($id)
    {
        if(count($volunteers = DB::table('shifts')
        ->join('locations', 'locations.id','=','shifts.location_id')
        ->join('sections','sections.id','=','locations.section_id')
        ->join('rosters','shifts.id','=','rosters.shift_id')
        ->join('volunteers', 'rosters.volunteer_id', '=', 'volunteers.id')
        ->where('shifts.id', '=', $id)
        ->select('volunteers.first_name','volunteers.last_name','volunteers.id','sections.name as section_name','sections.volunteer_id as section_lead_id','locations.name as location_name', 'shifts.start_time', 'shifts.name as shift_name','shifts.id as shift_id', '1 as exists' )
        ->get()) > 0){
        
            $section_lead = Volunteer::find($volunteers[0]->section_lead_id);
            return view('admin.editRosters', compact('volunteers', 'section_lead'));
        }else{
            $volunteers = DB::table('shifts')
            ->join('locations', 'locations.id','=','shifts.location_id')
            ->join('sections','sections.id','=','locations.section_id')
            ->where('shifts.id', '=', $id)
            ->select('sections.name as section_name','sections.volunteer_id as section_lead_id','locations.name as location_name', 'shifts.start_time' , 'shifts.name as shift_name', 'shifts.id as shift_id', '0 as exists')
            ->get();
                $section_lead = Volunteer::find($volunteers[0]->section_lead_id);
                return view('admin.editRosters', compact('volunteers', 'section_lead'));
            }
    }


    //create-----------------------------------------------------------------
    public function createSection(Request $request)
    {
        //check if section exists, if true return message, if false create section
        if (Section::where('name', strval($request->input('sectionName')))->exists()) {
            $section_name = strval($request->input('sectionName'));
            return "A Section named \"{$section_name}\" already exists.";
        }else{
            try{
                Section::create([
                    'volunteer_id' => $request->input('volId'),
                    'name' => $request->input('sectionName'),
                    'description' => $request->input('sectionDescription')
                ]);
                $leadVol = Volunteer::findOrFail($request->input('volId'));
                $leadUser = User::findOrFail($leadVol->user_id);
                $leadUser->is_section_lead = 1;
                $leadUser->save();
                return "Section was created successfully.";                
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
    }


    public function createLocation(Request $request)
    {
        //check if location name exists for the given section, if true return message, if false create location
        if (DB::table('locations')
            ->join('sections', 'sections.id', '=', 'locations.section_id')
            ->where('sections.id', $request->input('sectionId'))
            ->where('locations.name', $request->input('locationName'))
            ->exists()) 
        {
            $location_name = strval($request->input('locationName'));
            return "A location named \"{$location_name}\" already exists for that section.";
        }else{
            try{
                Location::create([
                    'section_id' => $request->input('sectionId'),
                    'name' => $request->input('locationName'),
                    'description' => $request->input('locationDescription')
                ]);
                return "Location was created successfully.";
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
    }

    public function createShift(Request $request)
    {
        $start_time = $request->input('shiftDay') . "T" . $request->input('startTime');
        $end_time =  $request->input('shiftDay') . "T" . $request->input('endTime');
        //check if shift name exists
        if (DB::table('locations')
            ->join('shifts', 'locations.id', '=', 'shifts.location_id')
            ->where('locations.id', $request->input('locationId'))
            ->where('shifts.name', $request->input('shiftName'))
            ->exists()) 
         {
            $shift_name = strval($request->input('shiftName'));
            return "A Shift named \"{$shift_name}\" already exists for this location.";

            //check if shift start-time or end-time exist
         }else if(strtotime(strval($start_time)) > strtotime(strval($end_time))){
            return "Shift \"start-time\" cannot be greater than \"end-time\"";

            //check if shift start-time or end-time falls on or between anothe shift
         }else if(count($evaluate_shifts = DB::table('locations')
            ->join('shifts', 'locations.id', '=', 'shifts.location_id')
            ->where('locations.id', $request->input('locationId'))
            ->where('shifts.start_time', $start_time)
            ->orWhere('shifts.end_time', $end_time)
            ->orWhereRaw('? between `start_time` and `end_time`', $start_time)
            ->orWhereRaw('? between `start_time` and `end_time`', $end_time)
            ->select('shifts.name', 'shifts.start_time', 'shifts.end_time')
            ->get()) > 0){

                $start_time_converted = date('h:i:s a m/d/Y', strtotime(strval($start_time)));
                $end_time_converted = date('h:i:s a m/d/Y', strtotime(strval($end_time)));

                $evaluation_string = "A Shift start time of \"{$start_time_converted}\" or an end time of \"{$end_time_converted}\" violated time constraints. The time lies on or between an existing shift.\n\nPlease review the following shifts for this location:\n";
                foreach($evaluate_shifts as $shift){
                    $name = $shift->name;
                    $start = date('h:i:s a m/d/Y', strtotime(strval($shift->start_time)));
                    $end = date('h:i:s a m/d/Y', strtotime(strval($shift->end_time)));
                    $evaluation_string .= "{$name}:  {$start} -> {$end}" . "\n";
                }
                return $evaluation_string;
            
            // if we reach this point create a new shift
         }else{
            try{
                Shift::create([
                    'location_id' => $request->input('locationId'),
                    'name' => $request->input('shiftName'),
                    'description' => $request->input('shiftDescription'),
                    'start_time' => $request->input('shiftDay') . "T" . $request->input('startTime'),
                    'end_time' => $request->input('shiftDay') . "T" . $request->input('endTime'),
                    'max_volunteers' => $request->input('numVolunteers'),
                    'current_volunteers' => 0,
                    'is_accepting' => true
                ]);
                return "Shift was created successfully.";
            }catch(Exception $e){
                return $e->getMessage();
            }
         }
    }

    public function registerVol($shiftid,$volid)
    {

        try{
            $shift = Shift::findOrFail($shiftid);
            if($shift->current_volunteers + 1 <= $shift->max_volunteers){
                Roster::create([
                    'shift_id' => $shiftid,
                    'volunteer_id' =>$volid,
                    'is_valid'  => true
                ]);
                $shift->current_volunteers = $shift->current_volunteers + 1;
                $shift->save();
                return "Volunteer was registered successfully";
            }else{
                return "Error, shift is already full";
            }
            
        }catch(Exception){
            return "The volunteer has already been registered for this shift";
        }
    }
    //delete-----------------------------------------------------------------
    public function unregisterVol($shiftid,$volid)
    {
        try{
            $shift = Shift::findOrFail($shiftid);
            if($shift->current_volunteers - 1 >= 0){
                DB::table('rosters')
                ->where('shift_id', $shiftid)
                ->where('volunteer_id', $volid)
                ->delete();

                $shift->current_volunteers = $shift->current_volunteers - 1;
                $shift->save();
                return "Volunteer was unregistered successfully";
            }else{
                return "Error, shift cannot be less than 0";
            }
        }catch(Exception $e){
            return $e->getMessage();
        }
    }


    //refresh page values with XMLHttpRequest----------------------------------------------------
    public function refreshSections()
    {
        $sections = DB::table('sections')
                      ->join('volunteers', 'sections.volunteer_id', '=', 'volunteers.id')
                      ->select('sections.name', 'sections.description', 'volunteers.first_name', 'volunteers.last_name')
                      ->get();
        return view('partial.displaysections', compact('sections'));
    }
    public function refreshLocations()
    {
        $locations = DB::table('locations')
                        ->join('sections', 'locations.section_id', '=', 'sections.id')
                        ->select('locations.name', 'locations.description', 'locations.id', 'sections.name as section')
                        ->get();
                        
        return view('partial.displaylocations', compact('locations'));
    }

    public function refreshVolShifts($id)
    {
        $volShifts = DB::table('shifts')
            ->join('rosters', 'shifts.id', '=', 'rosters.shift_id')
            ->join('locations', 'locations.id', '=', 'shifts.location_id')
            ->join('sections', 'sections.id', '=', 'locations.section_id')
            ->where('rosters.volunteer_id', '=', $id)
            ->select( 'shifts.id','sections.name as section_name', 'locations.name as location_name', 'shifts.name', 'shifts.start_time', 'shifts.end_time')
            ->get();
        $vol = Volunteer::find($id);
        return view('partial.displayvolshifts', compact('volShifts', 'vol'));
    }

    public function refreshSingleShift($id)
    {
        if(count($volunteers = DB::table('shifts')
        ->join('locations', 'locations.id','=','shifts.location_id')
        ->join('sections','sections.id','=','locations.section_id')
        ->join('rosters','shifts.id','=','rosters.shift_id')
        ->join('volunteers', 'rosters.volunteer_id', '=', 'volunteers.id')
        ->where('shifts.id', '=', $id)
        ->select('volunteers.first_name','volunteers.last_name','volunteers.id','sections.name as section_name','sections.volunteer_id as section_lead_id','locations.name as location_name', 'shifts.start_time', 'shifts.name as shift_name','shifts.id as shift_id', '1 as exists' )
        ->get()) > 0){
        
            $section_lead = Volunteer::find($volunteers[0]->section_lead_id);
            return view('partial.displaysingleshift', compact('volunteers', 'section_lead'));
        }else{
            $volunteers = DB::table('shifts')
            ->join('locations', 'locations.id','=','shifts.location_id')
            ->join('sections','sections.id','=','locations.section_id')
            ->where('shifts.id', '=', $id)
            ->select('sections.name as section_name','sections.volunteer_id as section_lead_id','locations.name as location_name', 'shifts.start_time' , 'shifts.name as shift_name', '0 as exists')
            ->get();
                $section_lead = Volunteer::find($volunteers[0]->section_lead_id);
                return view('partial.displaysingleshift', compact('volunteers', 'section_lead'));
        }
    }

    //send emails------------------------------------------------------------
    //ajax search user emails
    public function findEmails($search){
        $users = User::where('last_name', 'LIKE', '%'.$search.'%')->get();
        $email_array = [];
        foreach($users as $user){
            $user_array = [];
            $user_array['firstname'] = $user->first_name;
            $user_array['lastname'] = $user->last_name;
            $user_array['email'] = $user->email;
            array_push($email_array, $user_array);
        }
        return json_encode($email_array); 
    }

    //api triggers email event
    public function sendEmailAll(Request $request)
    {
        //currently functional, requires .env mailer configuration for smtp.
        try{
            $users = User::all();
            foreach($users as $user){
                Mail::to($user->email)->send(new NotifyUsers($user->first_name, $request->get('messageall'), Auth::user()->first_name, Auth::user()->last_name));
            }
            return "All users have been notified.";
        }catch(Exception $e){
            return $e->message();
        }

    }

    public function sendEmailUser(Request $request)
    {
        //currently functional, requires .env mailer configuration for smtp.
        try{
            $user = User::where('email', '=', $request->get('emailselect'))->firstOrFail();
            Mail::to($request->get('emailselect'))->send(new NotifyUsers($user->first_name, $request->get('messageuser'), Auth::user()->first_name, Auth::user()->last_name));
            return "User has been notified.";
        }catch(Exception $e){
            return $e->message();
        }

    }


    public function sendEmailSection(Request $request)
    {
        //currently functional, requires .env mailer configuration for smtp.
        
             $users = DB::table('users')
            ->join('volunteers', 'volunteers.user_id', '=', 'users.id')
            ->join('rosters', 'rosters.volunteer_id', '=', 'volunteers.id')
            ->join('shifts', 'shifts.id', '=', 'rosters.shift_id')
            ->join('locations', 'locations.id', '=', 'shifts.location_id')
            ->join('sections', 'sections.id','=','locations.section_id')
            ->where('locations.section_id', '=', $request->get('sectionselect'))
            ->select('users.first_name', 'users.last_name', 'users.email', 'sections.name as section_name')
            ->distinct()
            ->get();
            foreach($users as $user){
                Mail::to($user->email)->send(new NotifyUsers($user->first_name, $request->get('messagesection'), Auth::user()->first_name, Auth::user()->last_name));
            }
            return "{$users[0]->section_name} has been notified.";


    }
}
