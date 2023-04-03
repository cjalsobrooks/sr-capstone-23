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

    public function sectionLead(Request $id) {
        // //actual logic will go here not complete obviously

        //step 1: get section lead IDS and vol IDs associated w user
        // $sectionLeadIds = [];

        // $sections = DB::table('sections')
        //             ->join('volunteers', 'sections.volunteer_id', '=', 'volunteers.id')
        //             ->select('sections.*', 'volunteers.id as vID', 'volunteers.user_id as uID', 'volunteers.first_name as first', 'volunteers.last_name as last')
        //             ->where('uID', '=', $id);

        // $locations = DB::table('locations')
        //             ->joinSub($sections, 'user_sections', function(JoinClause $join) {
        //                 $join->on('locations.section_id', '=', 'user_sections.id');
        //             })
        //             ->select('user_sections.*', 'locations.id');

        // $shifts = DB::table('shifts')
        //             ->joinSub($locations, 'user_locations', function(JoinClause $join) {
        //                 $join->on('shifts.location_id', '=', 'user_locations.id');
        //             })
        //             ->select('user_locations.*', 'shifts.*')
        //             ->get();
        

        return view('lead.secLeadInfo');


        

 
    //     step 3: choose section where section lead id = current vol id
    //     step 4: join sections - locations - shifts 
    //     step 5: choose shifts that take place in section

        

    //     //  $sec = Section::where('userId', $cId);
    //     // $userSec = [];
    //     // foreach($sec as $s) {
    //     //     array_push($userSec, $s);
    //     // }
    //     return view('lead.secLeadInfo');
    // } 
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
            $vol_array = [];
            $vol_array['firstname'] = $vol->first_name;
            $vol_array['lastname'] = $vol->last_name;
            $vol_array['Id'] = $vol->id;
            array_push($names_array, $vol_array);
        }
        return json_encode($names_array);
    }
    

}
