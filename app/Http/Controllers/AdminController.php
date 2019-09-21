<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
  
    public function getSingin(){
        return view('admin.singin');
    }

    public function postSingin(Request $req){
        $credentials = $req->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('calendar');
        }
        else{
            return redirect('admin/singin')->with('alert','Đăng nhập không thành công');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('login');
    }

    public function getIndex(){
        return view('admin.admin_index');
    }
}
