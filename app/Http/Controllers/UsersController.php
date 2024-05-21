<?php

namespace App\Http\Controllers;

use App\Mail\CodigoVerificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            'phone.unique' => 'El telefono ya esta registrado en otra cuenta.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
        $code = mt_rand(100000, 999999);
        Mail::to($request->email)->send(new CodigoVerificacion($code));
        $hashedCode = Hash::make($code);
        
        User::create(array_merge(
                $validate->validated(),
                ['password'=>bcrypt($request->password),'code'=>$code]
            ));
            $credentials = $request->only('email', 'password');
            $token = JWTAuth::attempt($credentials);
            return redirect()->route('verifiycode')->withCookie('token',$token,120);
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
    public function verificarcodigo(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        if($user->code == $request->code){
            $user->active = 1;
            $user->save();
            return redirect()->route('dashboard');
        }
        else
        {
            return redirect()->back()->withErrors(['code'=>['codigo incorrecto']]);
        }
    }
    public function index()
    {
        $users = User::all();
        return view('IndexUsers')->with("users",$users);
    }
    public function clearCookieAndLogin()
    {
        // Invalidate the JWT token
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (\Exception $e) {
            // Handle the error if needed
        }

        // Redirect to the login page with a cookie that immediately expires
        return redirect()->route('login')->withCookie(cookie()->forget('token'));
    }
    public function show($id){
        $user = User::find($id);
        return view('editUser')->with("user",$user);
    }
    public function edit(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'lastname_p' => 'required',
            'lastname_m' => 'required',
            'age' => 'required|integer',
            'birthdate' => 'required|date',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'lastname_p.required' => 'El campo apellido paterno es obligatorio.',
            'lastname_m.required' => 'El campo apellido materno es obligatorio.',
            'age.required' => 'El campo edad es obligatorio.',
            'age.integer' => 'el campo edad tiene que ser un número entero',
            'birthdate.required' => 'El campo cumpleaños es obligatorio.',
            'birthdate.date' => 'El campo cumpleaños debe ser una fecha.',
            'email.required' => 'El campo email es obligatorio.',
            'email.string' => 'El email debe ser una cadena de texto.',
            'email.email' => 'El formato del email no es válido.',
            'email.unique' => 'El email ya está registrado.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.unique' => 'El teléfono ya está registrado en otra cuenta.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);
    
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }
    
        $user->update(array_merge(
            $validate->validated(),
            ['password' => $request->password ? bcrypt($request->password) : $user->password]
        ));
    
        return redirect()->route('indexusers')->with('success', 'Usuario actualizado correctamente.');
    }
}
