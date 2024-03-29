<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\GetRoomRequest;
use App\Http\Requests\PostBookingRequest;
use App\Http\Requests\PostDragRequest;
use App\Room;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;
class BookingController extends Controller
{
    //check Room 
    public function checkRoom($start, $end, $room_id=null)
    {
        $data = Booking::select([
            'from_datetime',
            'to_datetime',
            'room_id',
           
        ]);
        
        if ($room_id) {
            $data = $data->where('room_id', $room_id);
        }

        $data = $data->where(function (Builder $builder) use ($start, $end) {
            return $builder->where(function ($query) use ($start, $end) {
                    $query->whereDate('from_datetime', '<=', $start)
                        ->whereDate('to_datetime', '>=', $end);
                })->orWhere(function ($query) use ($start, $end) {
                    $query->whereDate('from_datetime', '>=', $start)
                        ->whereDate('from_datetime', '<=', $end);
                })->orWhere(function ($query) use ($start, $end) {
                    $query->whereDate('to_datetime', '>=', $start)
                        ->whereDate('to_datetime', '<=', $end);
                })->orWhere(function ($query) use ($start, $end) {
                    $query->whereDate('from_datetime', '>=', $start)
                        ->whereDate('to_datetime', '<=', $end);
                });
        })->get();
        return $data;
    }

    //get list booking by permission
    public function getListBookingsByPermission($start, $end)
    {
        $data = Booking::select([
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
            $data = $data->where('user_id', $user->id);
        }

        $data = $data->where(function (Builder $builder) use ($start, $end) {
                return $builder->where(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '<=', $start)
                            ->whereDate('to_datetime', '>=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('from_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('to_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    });
            })->get();
        return $data;
    }

    //check room in exclude
    public function checkRoomInExclude($start, $end, $room_id = null, $exclude = null)
    {
        $data = Booking::select([
            'from_datetime',
            'to_datetime',
            'room_id'
        ]);
    
        //get room to check
        if ($room_id) {
            $data = $data->where('room_id', $room_id);
        }

        if($exclude){
            if(!is_array($exclude)){
                $exclude = [$exclude];
            }
        }else{
            $exclude = [];
        }

        $data = $data->whereNotIn('room_id', $exclude);// trừ ra 

        $data = $data->where(function (Builder $builder) use ($start, $end) {
                return $builder->where(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '<=', $start)
                            ->whereDate('to_datetime', '>=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('from_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('to_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    });
            })->get();
        return $data;
    }
    
    // get room available
    public function getRooms(GetRoomRequest $request)
    {   
        $people = $request->input('people');
        $start = Carbon::parse($request->start)->toDateTimeString();
        $end = Carbon::parse($request->end)->toDateTimeString();
        $exclude = $request->input('exclude');

        $data = Room::select("*")
            ->where('status', 1)
            ->where('large', '>=' , $people);
 
        if($exclude){
            if(!is_array($exclude)){
                $exclude = [$exclude];
            }
        }else{
            $exclude = [];
        }

        $data = $data->where(function (Builder $builder) use ($start, $end, $exclude)  {
                return $builder->whereDoesntHave('bookings', function ($query) use ($start, $end, $exclude) {
                    $query->where(function(Builder $b) use ($start, $end){
                        $b->where( function($q) use ($start, $end) {
                            $q->whereDate('bookings.from_datetime', '<=', $start)
                                ->whereDate('bookings.to_datetime', '>=', $end);
                        })->orWhere(function ($q) use ($start, $end) {
                            $q->whereDate('bookings.from_datetime', '>=', $start)
                                ->whereDate('bookings.from_datetime', '<=', $end);
                        })->orWhere(function ($q) use ($start, $end) {
                            $q->whereDate('bookings.to_datetime', '>=', $start)
                                ->whereDate('bookings.to_datetime', '<=', $end);
                        })->orWhere(function ($q) use ($start, $end) {
                            $q->whereDate('bookings.from_datetime', '>=', $start)
                                ->whereDate('bookings.to_datetime', '<=', $end);
                        });
                    })->whereNotIn('bookings.room_id', $exclude);
                });
        });
        $data = $data->get();

        $response = [
            'error' => false,
            'message' => '',
            'data' => $data,
        ];
        return response()->json($response);
    }

    // convert datetime
    private function convertDatetime($start, $end){
        $start = Carbon::parse($start)->toDateTimeString();
        $end = Carbon::parse($end)->toDateTimeString();
        return [
            'start'=>$start,
            'end'=>$end
        ];
    }
    
    //get list bookings by room_id
    public function getListBookingsByRoomId($start, $end, $rooms=null)
    {
        $data = Booking::select([
                'id',
                'from_datetime',
                'to_datetime',
                'title',
                'room_id',
                'user_id',
                'color'
            ])->with(['room:id,name']);

        if ($rooms) {
            $data = $data->whereIn('room_id', $rooms);
        }

        $data = $data->where(function (Builder $builder) use ($start, $end) {
                return $builder->where(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '<=', $start)
                            ->whereDate('to_datetime', '>=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('from_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('to_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    });
            })->get();
        return $data;
    }

    //get list booking by day
    public function getListBookingsByDay($start, $end, $id)
    {
        $data = Booking::select(['id'])
                ->where(function (Builder $builder) use ($start, $end) {
                return $builder->where(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '<=', $start)
                            ->whereDate('to_datetime', '>=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('from_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('to_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    });
            })->get();
        return $data;
    }

    //! GET - POST
    
    public function getIndex()
    {
        $rooms = Room::orderBy('name','ASC')->get();
        return view('booking.booking_index',compact('rooms'));
    }

    public function getList(Request $request)
    {
        $response = [
            'error' => false, // if == true is function error, else false
            'data' => [],
            'message' => 'ban lay du lieu thanh cong',
        ];

        $date = $this->convertDatetime($request->start, $request->end);

        $event = $this->getListBookingsByPermission($date['start'], $date['end']);
        
        $rooms = $request->rooms;
        if($rooms){
            $event = $this->getListBookingsByRoomId($date['start'], $date['end'], $rooms);
        }

        $response['data'] = $event;
        return response()->json($response);
    }

    public function postAdd(PostBookingRequest $request)
    {
        $date = $this->convertDatetime($request->start, $request->end);
        $room_id = $request->room;
        $data = $this->checkRoom($date['start'], $date['end'],$room_id);

        if (!$data->count()) {
            $bookings = new Booking;
            $bookings->fill($request->only(['people', 'content', 'title', 'color']));
            $bookings->from_datetime = $date['start'];
            $bookings->to_datetime = $date['end'];
            $bookings->room_id = $room_id;
            $bookings->user_id = \Auth::user()->id;
            $bookings->save();
            return response()->json([
                'error' => false,
                'data' => $bookings,
                'message' => 'Success',
            ]);
        }
        return response()->json([
            'error' => true,
            'data' => [],
            'message' => 'Fail',
        ]);
    }

    public function getTotalOfRoom($start, $end, $room_id = null)
    {
        
        $data = Booking::select(['id', 'from_datetime', 'to_datetime', 'title', 'room_id'])
                        ->with(['room:id,name']);
        
        if ($room_id) {
            $data = $data->where('room_id', $room_id);               
        }

        $data = $data->where(function (Builder $builder) use ($start, $end) {
                return $builder->where(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '<=', $start)
                            ->whereDate('to_datetime', '>=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('from_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('to_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    });
            })->get();
        return $data;
    }

    public function checkEdit($start, $end, $room_id = null, $exclude = null)
    {
        
        $data = Booking::select(['id', 'from_datetime', 'to_datetime', 'title', 'room_id'])
                        ->with(['room:id,name']);
        
        if($exclude){
            if(!is_array($exclude)){
                $exclude = [$exclude];
            }
        }else{
            $exclude = [];
        }

        if ($room_id) {
            $data = $data->where('room_id', $room_id)
                         ->whereNotIn('id', $exclude);
                          
        }

        $data = $data->where(function (Builder $builder) use ($start, $end) {
                return $builder->where(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '<=', $start)
                            ->whereDate('to_datetime', '>=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('from_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('to_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    })->orWhere(function ($query) use ($start, $end) {
                        $query->whereDate('from_datetime', '>=', $start)
                            ->whereDate('to_datetime', '<=', $end);
                    });
            })->get();
        return $data;
    }

    public function getEdit($id=null, Request $request){
        if(!$id){
            $id = $request->input('id');
        }
        $booking = Booking::where('id',$id)->with(['room:id,name'])->first();

        $booking->has_edit = false;
        $user = Auth::user();
        if(!$user->hasPermission('bookings.edit')){
            $booking->has_edit = true;
        }

        return response()->json([
            'error' => false,
            'data' => $booking,
            'message' => 'Success',
        ]);
    }

    public function postEdit(PostBookingRequest $request)
    {
        $date = $this->convertDatetime($request->start, $request->end);
        $room = $request->room;
        $id = $request->id;
        $data = $this->checkEdit($date['start'], $date['end'], $room, $id);

        if (!$data->count()) {
            $bookings = Booking::find($request->id);
            $bookings->fill($request->only(['people', 'content', 'title']));
            $bookings->from_datetime = $date['start'];
            $bookings->to_datetime = $date['end'];
            $bookings->room_id = $room;
            $bookings->user_id = \Auth::user()->id;
            $bookings->save();
            return response()->json([
                'error' => false,
                'data' => $bookings,
                'message' => 'Success',
            ]);
        }
        return response()->json([
            'error' => true,
            'data' => [],
            'message' => 'Fail',
        ]);
    }

    public function postDrag(PostDragRequest $request)
    {
        $date = $this->convertDatetime($request->start, $request->end);
        $bookings = Booking::find($request->id);
        $id = $request->id;
        $room = $bookings->room_id;
       
        $data = $this->checkEdit($date['start'], $date['end'], $room, $id);
     
        if (!$data->count()) { 

            $bookings->from_datetime = $date['start'];
            $bookings->to_datetime = $date['end'];
            $bookings->user_id = \Auth::user()->id;
            $bookings->save();

            return response()->json([
                'error' => false,
                'data' => $bookings,
                'message' => 'Success',
            ]);
        }

        return response()->json([
            'error' => true,
            'data' => [],
            'message' => 'Fail',
        ]);

    }

    public function postDelete(Request $request){
        $bookings = Booking::find($request->id);
        $bookings->delete();
        
        return response()->json([
            'error' => false,
            'message' => 'Success',
        ]);
        
        
    }

    public function getBookings(Request $request){
        $date = $this->convertDatetime($request->start, $request->end);
        $rooms = $request->rooms;
        $data = $this->getListBookingsByRoomId($date['start'], $date['end'], $rooms);
        
        if(!$data->count()){
            return response()->json()([
                'error' => false,
                'data' => $data,
                'message' => 'Success'
            ]);
        }
        
        return response()->json()([
            'error' => true,
            'data' => $data,
            'message' => 'Fail'
        ]); 
    }
}
