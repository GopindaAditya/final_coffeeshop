<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuhtController extends Controller
{
    function index()
    {
        return view('loginForm');
    }
    function login(Request $request)
    {
        $cradentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($cradentials)) {
            return redirect()->route('customer.menu');
        } elseif (Auth::guard('owners')->attempt($cradentials)) {            
            return redirect()->route('owner');
        } elseif (Auth::guard('kasirs')->attempt($cradentials)) {
            return redirect()->route('kasir');
        } else {
            return redirect()->back()->withErrors("email atau password salah")->withInput();
        }

    }

    function showReq()
    {
        return view('register');
    }

    function register(Request $request)
    {
        $cradential = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'password' => 'required',            
        ]);
        if ($request->password == $request->rpPassword) {
            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->alamat = $request->alamat;
            $data->telepon = $request->telepon;
            $data->save();

            return redirect()->route('login');
        }else {
            return redirect()->back()->withErrors($cradential)->withInput();
        }

    }

    function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}