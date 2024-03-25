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
    public function index()
    {
        $users = User::where('status','=','active')->get();
        return view('home',compact('users'));
    }
    
    public function accept($id)
{
    // dd($id);
    $user = User::find($id);

    if ($user) {
        $user->status = 'active';
        $user->save();
        return redirect()->back()->with('success', 'User accepted successfully.');
    } else {
        return redirect()->back()->with('error', 'User not found.');
    }
}


public function deny($id)
{
    $user = User::find($id);

    if ($user) {
        // Here, you can define what you want to do when denying the user.
        // For example, you might want to mark them as denied or perform other actions.
        // This is just a placeholder, replace it with your desired logic.
        $user->status = 'denied';
        $user->save();
        return redirect()->back()->with('success', 'User denied successfully.');
    } else {
        return redirect()->back()->with('error', 'User not found.');
    }
}

    

}
