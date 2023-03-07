<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // actual logic will go here not complete obviously
        return view('lead.secLeadInfo');
    } 
}
