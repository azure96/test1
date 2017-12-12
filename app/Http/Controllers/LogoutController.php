<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * 用户注销处理
     */
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
