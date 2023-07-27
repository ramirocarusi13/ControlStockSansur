<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\User;
use App\Models\Login;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function view() {

        return view('logins.login'); 
    }

    public function login(Request $request) {
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::Attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return to_route('home.home');
        
        } else {

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            session()->flash('problem', 'Usuario o contraseña incorrecta');

            return to_route('login.view');
        }
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }

    public function verification($code) {
        
        $login = Login::where('verification_code', $code)
            ->where('active', true)->first();

        if($login) {

            $verification_code_expiration_date = $login->verification_code_expiration_date;

            $parts = explode(' ', $verification_code_expiration_date);
            $expiration_date = $parts[0];
            $expiration_time = $parts[1];

            $current_timestamp = Carbon::now();
            $current_parts = explode(' ', $current_timestamp);
            $current_date = $current_parts[0];
            $current_time = $current_parts[1];

            $since_start = $current_timestamp->diff($verification_code_expiration_date);

            if($since_start->days == 0 && $since_start->y == 0
                && $since_start->m == 0 && $since_start->d == 0
                && $since_start->h == 0 && $since_start->i < 20) {
                    
                $login->verified = true;
                $login->verification_date = Carbon::now();

                $login->save();

                return view('users.verification')
                    ->with('verified', true);

            } 

            return view('users.verification')
                ->with('verified', false);

        }

        return view('users.verification')
            ->with('verified', false);
    }

    public function register() {

        return view('register.register');
    }

    public function register_user(Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'dni' => ['required'],
            'phone_number' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'min:6', 'required_with:password', 'same:password'],
        ]);

        if($validator->fails()) {

            $errors = $validator->errors();

            if($errors->has('first_name')) {

                session()->flash('error_first_name', $errors->first('first_name'));
            }

            if($errors->has('last_name')) {

                session()->flash('error_last_name', $errors->first('last_name'));
            }

            if($errors->has('dni')) {

                session()->flash('error_dni', $errors->first('dni'));
            }

            if($errors->has('phone_number')) {

                session()->flash('error_phone_number', $errors->first('phone_number'));
            }

            if($errors->has('email')) {

                session()->flash('error_email', $errors->first('email'));
            }

            if($errors->has('password')) {

                session()->flash('error_password', $errors->first('password'));
            }

            if($errors->has('password_confirmation')) {

                session()->flash('error_password_confirmation', $errors->first('password_confirmation'));
            }

            return to_route('register.view');
        }

        $user = new User;

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->dni = $request->input('dni');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        session()->flash('status', 'Usuario creado!');

        return to_route('login.view');
    }
}
