<?php

namespace App\Http\Controllers;
use Exception;
use Auth;
use \Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Section;
use App\Models\Location;
use App\Models\Shift;
use App\Models\Roster;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUsers;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.userHome');
    }

    public function emailSupervisor() {
        return view('user.emailSupervisor');
    }

    public function riverbendMap() {
        return view('user.riverbendMap');
    }

    // fn to get sections associated with user 
    public function sectionLead(Request $id) {

        $user = Auth::User();

        $userGroup = DB::table('volunteers')
                    ->where('user_id', $user->id)
                    ->get();

        $vols = [];
        foreach($userGroup as $v) {
            array_push($vols, $v->id);
        }

        $sections = Section::whereIn('volunteer_id', $vols)->get();

        $locations = Location::all();        

        return view('lead.secLeadInfo', compact('sections', 'locations', 'vols'));

    }

    public function secLeadFindLocations($search) {
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

    public function viewGroup($id)
    {
        $volunteers = DB::table('volunteers')
                        ->where('user_id', $id)
                        ->select('id', 'first_name', 'last_name')
                        ->get();
        
        $result = [];
        foreach ($volunteers as $volunteer) {
            $obj = new \stdClass();
            $obj->id = $volunteer->id;
            $obj->first_name = $volunteer->first_name;
            $obj->last_name = $volunteer->last_name;
            $result[] = $obj;
        }

        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT)
                    ->header('Content-Type', 'application/json');
    }

    //ajax search volunteers
    public function findGroupByID(){
        $userId = Auth::user()->id;
        $volunteers = Volunteer::where('user_id', '=', $userId)->get();
        $names_array = [];
        foreach($volunteers as $vol){
            $vol_array = [
                'id' => $vol->id,
                'first_name' => $vol->first_name,
                'last_name' => $vol->last_name,
            ];
            array_push($names_array, $vol_array);
        }
        return response()->json(['volunteers' => $names_array]);
    }
    
    

}
