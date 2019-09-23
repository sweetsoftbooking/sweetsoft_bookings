<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function getAdd(){
        return view('event.event_add');
    }

    public function postAdd(EventRequest $request){
        $event = new Event;
        $event->fill($request->input());
        $event->save();
        return back()->with('alert','Add Success');
    }

    public function getIndex(){
        $event=Event::paginate(5);
        return view('event.event_index',compact('event'));
    }

    public function getEdit($id){
        $event=Event::find($id);
        return view('event.event_edit',compact('event'));
    }

    public function postEdit(EventRequest $request,$id){
        $event = Event::find($id);
        $event->fill($request->input());
        $event->save();
        return back()->with('alert','Edit Success !');
    }

    public function getDelete($id){
        $event=Event::find($id);
        $event->delete();
        return redirect()->route('events.list')->with('alert','Delete Success');
    }
}
