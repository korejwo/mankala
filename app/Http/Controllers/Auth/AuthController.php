<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Write code on Method
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('')->withSuccess('You have successfully logged in.');
        }

        return redirect('login')->withSuccess('You have entered invalid credentials.');
    }

    /**
     * Write code on Method
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('')->withSuccess('You have successfully registered.');
    }

    /**
     * Write code on Method
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('login')->withSuccess('You do not have access.');
        }

        $userGames = Game::where('user_id', Auth::id())->get();

        return view('auth.dashboard', [
            'games' => $userGames,
        ]);
    }

    /**
     * Write code on Method
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
