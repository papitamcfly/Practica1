<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    public function register (Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'lastname_p'=>'required',
            'lastname_m'=>'required',
            'age'=>'required|integer',
            'birthdate'=>'required|date',
            'email' => 'required|string|email|unique:users',
            'phone'=>'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
                ],[
            'name.required' => 'El campo nombre es obligatorio.',
            'lastname_p.required' => 'El campo apellido paterno es obligatorio.',
            'lastname_m.required' => 'El campo apellido materno es obligatorio.',
            'age.required' => 'El campo edad es obligatorio.',
            'age.integer'=>'el campo edad tiene que ser un numero entero',
            'birthdate.required' => 'El campo cumpleaños es obligatorio.',
            'birthdate.date' => 'El campo cumpleaños debe ser una fecha.',
            'email.required' => 'El campo email es obligatorio.',
            'email.string' => 'El email debe ser una cadena de texto.',
            'email.email' => 'El formato del email no es válido.',
            'email.unique' => 'El email ya está registrado.',
            'phone.required' => 'El campo telefono es obligatorio.',
            'phone.required' => 'El telefono ya esta registrado en otra cuenta.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        User::create(array_merge(
                $validate->validated(),
                ['password'=>bcrypt($request->password)]
            ));
            return redirect()->route('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return redirect()->back()->withErrors([
                    'email' => ['Las credenciales proporcionadas son incorrectas.'],
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'email' => ['No se pudo crear el token.'],
            ]);
        }

        return redirect()->route('dashboard')->withCookie(cookie('token', $token, 120));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
