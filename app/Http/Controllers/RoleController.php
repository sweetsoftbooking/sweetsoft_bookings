<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Carbon\Carbon;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function getAdd(){
        return view('role.role_add');
    }

    public function postAdd(RoleRequest $req){
        // $permissions = [];
        // foreach($req->input('permissions') as $key => $value){
        //     foreach($value as $k => $v){
        //         // print_r($k);
        //         // print_r($v);
        //         $permissions[$k] = true;
        //     }
        // }
        // print_r(json_encode($permissions));die;

        $role = new Role;
        $role->name = $req->name;
        $role->description = $req->description;
        $permissions = json_encode($req->permissions); //implode(",",$req->permissions);
        // print_r($permissions);die; //json_encode($permissions);
        $role->permissions=$permissions;
        $role->is_default = $req->is_default;
        $role->save();
        return back()->with('alert','Add Success');
    }

    public function getIndex(){
        $role=Role::all();
        return view('role.role_index',['role'=>$role]);
    }

    public function getEdit($id){
        $role=Role::find($id);
        
        $permissions=json_decode($role->permissions);
        
    //    $permissions=explode(",","$role->permissions");
    //    dd($permissions);die;
        
        return view('role.role_edit',compact('role','permissions'));
    }

    public function postEdit(Request $req,$id){
        $role = Role::find($id);
        $role->name = $req->name;
        
        $role->description = $req->description;
        // $role->permissions = implode(',',$req->permissions);
        $permissions = json_encode($req->permissions);
        
        // dd($role->permissions);die;
        $role->permissions=$permissions;
        $role->is_default = $req->is_default;
        $role->updated_at=Carbon::now();
        $role->save();
        return back()->with('alert','Edit Success !');
    }

    public function getDelete($id){
        $role=Role::find($id);
        $role->delete();
        return redirect('admin/role')->with('alert','Delete Success');
    }
}
