<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        // dd($cradentials);
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

    function generateOtp() {
        return rand(1000, 9999);
    }

    function register(Request $request)
    {
        $cradential = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'telepon' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'   
        ]);
        
        if (User::where('email', $request->email)->exists() || User::where('telepon', $request->telepon)->exists()) {
            // return response()->json(["error" => "Email or telepon already exists"], 400);
            return redirect()->route('register')->with('error', 'Email or telepon already exists');

        }
        else if ($request->password == $request->password_confirmation) {
            $telepon = $request->telepon;
            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->alamat = $request->alamat;
            $data->telepon = $telepon;
            $otp = $this->generateOtp();
            Session::put('otp', $otp);
            Session::put('telepon', $telepon);            
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $telepon,
                    'message' => 'Terima kasih telah mendaftar di layanan kami. Untuk menyelesaikan proses pendaftaran, kami memerlukan verifikasi akun Anda.

Berikut adalah kode verifikasi Anda: '.$otp. '
                    
Harap masukkan kode ini pada halaman verifikasi akun kami. Jangan berikan kode ini kepada siapapun, karena ini adalah informasi rahasia yang digunakan untuk mengamankan akun Anda.
                    
Jika Anda tidak merasa melakukan pendaftaran di layanan kami, mohon abaikan pesan ini.
                    
Terima kasih atas perhatian Anda',
                    'countryCode' => '62',
                    //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Ph2GJQCYaeAs7yCy8HTW' //change TOKEN to your actual token
                ),
            )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            $data->save();
            Auth::login($data);
            return view('verify-otp');
            // return redirect()->route('login');
        }else {
            return redirect()->back()->withErrors($cradential)->withInput();
        }

    }

    function resendOtp(){
        $telepon = Session::get('telepon');
        $otp = $this->generateOtp();
        Session::put('otp', $otp);
        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $telepon,
                    'message' => 'Terima kasih telah mendaftar di layanan kami. Untuk menyelesaikan proses pendaftaran, kami memerlukan verifikasi akun Anda.

Berikut adalah kode verifikasi Anda: '.$otp. '
                    
Harap masukkan kode ini pada halaman verifikasi akun kami. Jangan berikan kode ini kepada siapapun, karena ini adalah informasi rahasia yang digunakan untuk mengamankan akun Anda.
                    
Jika Anda tidak merasa melakukan pendaftaran di layanan kami, mohon abaikan pesan ini.
                    
Terima kasih atas perhatian Anda',
                    'countryCode' => '62',
                    //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Ph2GJQCYaeAs7yCy8HTW' //change TOKEN to your actual token
                ),
            )
            );

            $response = curl_exec($curl);

            curl_close($curl);
            return response()->json('success send otp', 200);
    }

    function verifyOtp(Request $request) {
        $userInput = $request->input('otp');
        $storeOtp = Session::get('otp');

        if($userInput == $storeOtp){            
            $user = auth()->user();             
            $user->verified = 1;
            $user ->save();

            Session::forget('otp');            
            return redirect()->route('manu');
        }
    }

    function showForgotPassword(){
        return view('forgotPassword');
    }

    function sendOtp(Request $request) {
        $telepon = $request->telepon;            
        $otp = $this->generateOtp();
        

        $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $telepon,
                    'message' => 'Terima kasih telah mendaftar di layanan kami. Untuk menyelesaikan proses pendaftaran, kami memerlukan verifikasi akun Anda.

Berikut adalah kode verifikasi Anda: '.$otp. '
                    
Harap masukkan kode ini pada halaman verifikasi akun kami. Jangan berikan kode ini kepada siapapun, karena ini adalah informasi rahasia yang digunakan untuk mengamankan akun Anda.
                    
Jika Anda tidak merasa melakukan pendaftaran di layanan kami, mohon abaikan pesan ini.
                    
Terima kasih atas perhatian Anda',
                    'countryCode' => '62',
                    //optional
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Ph2GJQCYaeAs7yCy8HTW' //change TOKEN to your actual token
                ),
            )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            Session::put('otp',$otp);
            Session::put('telepon', $telepon);
            return response()->json('success send otp', 200);
    }

    function forgotPassword(Request $request){
        $userInput = $request->otp;
        $storeOtp = Session::get('otp');

        if($userInput == $storeOtp){                               
            Session::forget('otp');            
            return response()->json('success', 200); // Send JSON response to the client
        }else{
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    function showResetPassword(){
        return view('resetPassword');
    }
    function resetPassword(Request $request){
        $cradential = $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'   
        ]);

        $telepon = Session::get('telepon');
        if($request->password == $request->password_confirmation){
            $user = User::where('telepon', $telepon)->first();            
            $user ->password = bcrypt($request->password);
            $user -> save();
            Session::forget('telepon');
            return redirect()->route('login');
        }else{
            return redirect()->back()->withErrors($cradential)->withInput();
        }
    }

    function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}