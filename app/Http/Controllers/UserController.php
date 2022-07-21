<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $profiles = User::with('profiles')->find(Auth::id())->get();
        return view('profile.index',compact('profiles'));
    }
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function create()
    {
        return view('profile.create');
    }
    /**
     * Write Your Code..
     *
     * @return string
    */

    public function show($id)
    {
        $profile = User::where('id',$id)->first();
        // return $profile;
        return view('profile.show',compact('profile'));
    }
}
