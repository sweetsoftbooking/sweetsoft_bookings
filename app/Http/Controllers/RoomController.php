<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Http\Requests\RoomRequest;

class RoomController extends Controller
{
    public function getAdd(){
        return view('room.room_add');
    }

    public function postAdd(RoomRequest $request){
        $room = new Room;
        $room->fill($request->input());
        $room->user_id = \Auth::user()->id;
        $room->save();
        return back()->with('alert','Add Success');
    }

    public function getIndex(){
        $room=Room::paginate(5);
        return view('room.room_index',compact('room'));
    }

    public function getEdit($id){
        $room=Room::find($id);
        return view('room.room_edit',compact('room'));
    }

    public function postEdit(Request $request,$id){
        $room = Room::find($id);
        $room->fill($request->input());
        $room->save();
        return back()->with('alert','Edit Success !');
    }

    public function getDelete($id){
        $room=Room::find($id);
        $room->delete();
        return redirect()->route('rooms.list')->with('alert','Delete Success');
    }
}
