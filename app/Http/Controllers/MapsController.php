<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class MapsController extends Controller
{
    public function mapview(){
        $user = auth()->user();
        return view('maps')->with("user",$user);
    }


}
