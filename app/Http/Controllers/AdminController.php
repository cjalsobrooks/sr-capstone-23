<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Volunteer;
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

    //edit user admin status-------------------------------------------
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
        $users = User::all();
        return view('admin.editSchedules', compact('users'));
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
