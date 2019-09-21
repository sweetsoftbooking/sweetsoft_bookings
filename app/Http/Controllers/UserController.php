<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Role_User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function getAdd(){
        $role=Role::all();
        return view('user.user_add',compact('role'));
    }

    public function postAdd(UserRequest $req){ 
       
        $role=Role::find($req->role);
        $permissions=json_decode($role->permissions);
        
        $user=new User;
        $user->username=$req->username;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->department=$req->department;
        $user->position=$req->position;
        $user->password=Hash::make($req->password);
        $user->permissions=$permissions;
        $user->information=$req->information;
        $user->age=$req->age;
        $user->is_super = $req->is_super;
        $user->save();

        $r_user=new Role_User;
        $r_user->role_id = $req->role;
        $r_user->user_id = $user->id;
        $r_user -> save();

        return back()->with('alert','Add Success');
    }

    public function getIndex(){
        $user=User::with(['roles'])->paginate(5);
        return view('user.user_index',compact('user'));
    }   

    public function getEdit($id){
        $role=Role::all();
        $user=User::find($id);

        $selected = $user->role_user->pluck('role_id', 'id')->toArray();

        return view('user.user_edit',compact('user','role','selected'));
    }

    public function postEdit($id, UserRequest $request){
        $role = Role::find($request->role);
        $permissions = json_decode($role->permissions);
        
        $user = User::find($id);
        //$user->fill($request->only(['username', 'email', 'name']));
        $user->fill($request->input());

        $user->permissions = $permissions;
        $user->save();

        // remove all role_users with user current
        $user->roles()->detach();
        $user->roles()->attach($role->id);

        return redirect('admin/user')->with('alert','Edit Success');
    }

    public function getDelete($id){
        $user=User::find($id);
        $user->delete();
        return redirect('admin/user')->with('alert','Delete Success');
    }
}
