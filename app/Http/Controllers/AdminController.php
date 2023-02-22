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
use Illuminate\Support\Facades\Mail;
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
        return view('admin.adminHome', compact('users'));
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
        return $user_array;
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
            $found_array['current'] = $shift->current_volunteers;
            $found_array['max'] = $shift->max_volunteers;
            $found_array['start'] = $shift->start_time;
            $found_array['end'] = $shift->end_time;
            array_push($shift_array, $found_array);
        }
        return $shift_array;
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
        return $location_array;
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
        return json_encode($names_array);
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



    //create-----------------------------------------------------------------
    public function createSection(Request $request)
    {
        //where query behavior needs to be further evaluated, not yet working correctly
        $section = Section::where('name', strval($request->input('sectionName')))->get();
        if(!is_null($section)){
            try{
                Section::create([
                    'volunteer_id' => $request->input('volId'),
                    'name' => $request->input('sectionName'),
                    'description' => $request->input('sectionDescription')
                ]);
                return "Section was created successfully.";
            }catch(Exception $e){
                return $e->getMessage();
            }
        }else{
            return "A section with that name already exists.";
        }
    }


    public function createLocation(Request $request)
    {
        //where query behavior needs to be further evaluated, not yet working correctly
        $location = Location::where('name', strval($request->input('sectionName')))->get();
        if(!is_null($location)){
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
        }else{
            return "A location with that name already exists.";
        }
    }

    public function createShift(Request $request)
    {
        //where query behavior needs to be further evaluated, not yet working correctly
        $shift = Shift::where('name', strval($request->input('sectionName')))->get();
        if(!is_null($shift)){
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
                return "Location was created successfully.";
            }catch(Exception $e){
                return $e->getMessage();
            }
        }else{
            return "A location with that name already exists.";
        }
    }


    //refresh page values----------------------------------------------------
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
    public function sendEmail()
    {
        //currently functional, requires .env mailer configuration for smtp.
        $users = User::all();
        foreach($users as $user){
            Mail::to($user->email)->send(new NotifyUsers($user->name));
        }
    }

}
