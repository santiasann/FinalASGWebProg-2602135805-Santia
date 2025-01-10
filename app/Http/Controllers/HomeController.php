<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = User::where('id', '!=', auth()->id()); 

        // Apply filters
        if ($request->has('gender')) {
            $users = $users->where('gender', $request->gender);
        }

        if ($request->has('job')) {
            $users = $users->whereJsonContains('fields_of_work', $request->field_of_work);
        }

        return view('home', compact('users'));
    }
}
