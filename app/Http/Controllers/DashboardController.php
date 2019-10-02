<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class DashboardController extends Controller
{
    public function getIndex(){
        $bookings = $this->BookingToday();
        return view('admin.admin_index',compact('bookings'));
    }

    public function BookingToday(){
        $bookings = Booking::with('room:id,name')
                    ->whereDate('from_datetime','<=',Carbon::today())
                    ->whereDate('to_datetime','>=',Carbon::today())
                    ->paginate(10); 
        
        $user = Auth::user();
        if(!$user->hasPermission('bookings.list')){
            $bookings = $bookings->where('user_id',$user->id);
        }

        return $bookings;
    }

    public function BookingWeek(){
        $dayStart = Carbon::now()->startOfWeek();
        $dayEnd = Carbon::now()->endOfWeek();
        
        $bookings = Booking::select([
            'id',
            'from_datetime',
            'to_datetime',
            'title',
            'room_id',
            'user_id',
            'color'
        ])->with(['room:id,name']);
        
        $user = Auth::user();
        if(!$user->hasPermission('bookings.list')){
            $bookings = $bookings->where('user_id',$user->id);
        }

        $bookings = $bookings->where(function (Builder $builder) use ($dayStart, $dayEnd) {
            return $builder->where(function ($query) use ($dayStart, $dayEnd) {
                    $query->whereDate('from_datetime', '<=', $dayStart)
                        ->whereDate('to_datetime', '>=', $dayEnd);
                })->orWhere(function ($query) use ($dayStart, $dayEnd) {
                    $query->whereDate('from_datetime', '>=', $dayStart)
                        ->whereDate('from_datetime', '<=', $dayEnd);
                })->orWhere(function ($query) use ($dayStart, $dayEnd) {
                    $query->whereDate('to_datetime', '>=', $dayStart)
                        ->whereDate('to_datetime', '<=', $dayEnd);
                });
        })->paginate(10);
        return $bookings;
    }

    public function postBookingDelete(Request $request){
        $booking = Booking::find($request->id);
        $booking->delete();
        $bookings = $this->BookingToday();

      
        return response()->json([
            'error' => false,
            'data' => $bookings,
            'message' => 'Success'
        ]);
        
    }

    public function getBookingWeek(){
        $bookings = $this->BookingWeek();
        $data = '';
        foreach($bookings as $book){
            $data .= view('partials.dashboard.item-room', compact('book'))->render();
        }
        return response()->json([
            'error' => false,
            'data' => $bookings,
            'message' => 'Success'
        ]);
    }

    public function getBookingToday(){
        $bookings = $this->BookingToday();
        $data = '';
        foreach($bookings as $book){
            $data .= view('partials.dashboard.item-room', compact('book'))->render();
        }
        return response()->json([
            'error' => false,
            'data' => $bookings,
            'message' => 'Success'
        ]);
    }
}
