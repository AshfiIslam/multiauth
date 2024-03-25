<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    private $user;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function loginUser(Request $request)
    {

        $this->user = User::where('email', $request->email)->first();

        if ($this->user->usertype == 'admin') {
            return redirect()->back()->with('message', 'Only user can login');
        }



        if ($this->user) {
            if (password_verify($request->password, $this->user->password)) {
                Session::put('user_id', $this->user->id);
                Session::put('user_name', $this->user->name);
                return redirect('/user/dashboard');
            } else {
                return redirect()->back()->with('message', 'Password is invalid');
            }
        } else {
            return redirect()->back()->with('message', 'Email address is invalid');
        }
    }

    public function adminlogin(Request $request)
    {
         

        $this->user = User::where('email', $request->email)->first();

        if ($this->user->usertype == 'user') {
            return redirect()->back()->with('message', 'Only admin can login');
        }



        if ($this->user) {
            if (password_verify($request->password, $this->user->password)) {
                

                $credentials = [
                    'email' => $request->email,
                    'password' => $request->password
                ];

                if (auth()->attempt($credentials)) {
                    # code...
                    return redirect('/home');
                    // return view('home',compact('users'));
                }

            } else {
                return redirect()->back()->with('message', 'Password is invalid');
            }
        } else {
            return redirect()->back()->with('message', 'Email address is invalid');
        }
    }

    public function loginPage()
    {
        return view('userForm.login');
    }

    public function homepage()
    {
        $users = User::where('status','=','active')->get();
        return view('home',compact('users'));
    }
    // public function accept($id)
    // {
    //     $data = User::find($id);
    //     $data->staus = 'active';
    //     $data->save();
    //     return redirect()->back();
    // }
    // public function deny()
    // {

    // }
}
