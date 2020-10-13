<?php

namespace App\Http\Controllers;

use App\Models\patient;
use Carbon\Carbon;

class HomeController extends Controller
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $healthy = patient::where('status','healthy')->get()->count();
        $injured=patient::where('status','injured')->get()->count();
        $contact=patient::where('status','contact')->get()->count();
        return view('dashboard',compact('healthy','injured','contact'));
    }
}
