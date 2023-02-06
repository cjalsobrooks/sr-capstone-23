<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function permissions($id)
    {
        $user = User::find($id);
        return view('admin.permissions', compact('user'));
    }

    public function editPermissions(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');

        if($request->input('is_admin') == null){
            $user->is_admin = 0;
        }else{
            $user->is_admin = $request->input('is_admin');
        }

        $user->email = $request->input('email');
        $user->save();

        return view('admin.permissions', compact('user'));
    }

    //send emails------------------------------------------------------------
    public function findEmails($search){
        $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
        $email_array = [];
        foreach($users as $user){
            $user_array = [];
            $user_array['name'] = $user->name;
            $user_array['email'] = $user->email;
            array_push($email_array, $user_array);
        }
        return json_encode($email_array);
    }

    public function sendEmail()
    {
        //currently functional, requires .env mailer configuration for smtp.
        $users = User::all();
        foreach($users as $user){
            Mail::to($user->email)->send(new NotifyUsers($user->name));
        }
    }

}
