<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

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

    public function permissions($id)
    {
        $user = User::find($id);
        return view('admin.permissions', compact('user'));
    }
}
