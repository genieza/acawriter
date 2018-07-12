<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Feature;
use App\Document;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $userData;


    public function __construct()
    {
        $this->middleware('auth');
        $this->userData = new \stdClass;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //roles
        $roles = Auth::user()->roles;
        $this->userData->roles = array();
        foreach($roles as $role) {
            $this->userData->roles[] = $role->name;
        }
        $this->userData->features = Feature::all();

        return view('home', ['data'=> $this->userData]);
    }

    public function page ($which) {
        if(!isset($which)) {
            return view ('welcome');
        } elseif($which==='about') {
            return view('about');
        } elseif($which==='contact') {
            return view('contact');
        } else {
            return view ('welcome');
        }
    }





}
