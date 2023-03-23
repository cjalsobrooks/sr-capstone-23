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

    public function sectionLead() {
        // //actual logic will go here not complete obviously

        //step 1: get section lead IDS and vol IDs associated w user

        // $sectionLeadIds = [];

        // $sections = DB::table('sections')
        //               ->join('volunteers', 'sections.volunteer_id', '=', 'volunteers.id')
        //               ->select('sections.name', 'sections.description', 'sections.id', 'volunteers.first_name', 'volunteers.last_name', 'volunteers.id as volId')
        //               ->get();

        // foreach($sections as $section){
        //     array_push($sectionLeadIds, $section->volId);
        // }

        // $volunteers = Volunteer::All();

        // $uVols = Volunteer::where('user_id', Auth::user()->id)->get();
        
        // $userSections = [];
        // foreach($uVols as $vol) {
        //     if (Section::where('volunteer_id', $vol->id)->exists())
        //     {
        //         array_push($userSections, Section::where('volunteer_id', $vol->id)->get());
        //     }
        // }

        // return view('lead.secLeadInfo', compact('userSections'));


        

 
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
}
