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

    public function edit($userId, Request $request)
    {
        // mapping request data
        $data = $request->all();
        return $data;

        $user = User:: findorFail($userId);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar');
            $avatar_name = 'media/profile/'.$user->id.'.'.$avatar->getClientOriginalExtension();
            $user->update(['avatar' => $avatar_name]);
            $avatar->move('media/profile',$user->id.'.'.$avatar->getClientOriginalExtension());
        }

        // Send Email to User
        // Mail::to($checkout->User->email)->send(new Paid($checkout));

        $request->session()->flash('success', "Prospect with ID {$user->id} has been updated");

        return redirect(route('admin.profile'));
    }
}
