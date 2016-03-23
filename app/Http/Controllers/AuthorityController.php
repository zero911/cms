<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-23
 * Time: 下午1:32
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorityController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function login(Request $request){

        return view('auth.login');
    }

}