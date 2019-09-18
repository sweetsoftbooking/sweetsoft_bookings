<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function getSingup(){
        return view('admin.singup');
    }

    public function postSingup(Request $req){
        $user=new User;
    	$user->username=$req->username;
    	$user->password=Hash::make($req->password);
        $user->email=$req->email;
        $user->name=$req->name;
        $user->age=$req->age;
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->information=$req->information;
        $user->department=$req->department;
        $user->position=$req->position;
        $user->permissions=$req->permissions;
        $user->created_at=Carbon::now();
        $user->save();
        return redirect('calendar');
    }

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
}
