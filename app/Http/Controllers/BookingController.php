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
            'id',
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

    //get list booking
    public function getListingBookings($start, $end, $room_id = null, $exclude = null)
    {
        $data = Booking::select([
                'id',
                'from_datetime',
                'to_datetime',
                'title',
                'room_id',
                'user_id'
            ])->with(['room:id,name']);
            
        if ($room_id) {
            $data = $data->where('room_id', $room_id);
        }

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
            'id',
            'from_datetime',
            'to_datetime',
            'title',
            'room_id',
            'user_id'
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
    
    //! GET - POST
    
    public function getIndex()
    {
        return view('booking.booking_index');
    }

    public function getListing(Request $request)
    {
        $response = [
            'error' => false, // if == true is function error, else false
            'data' => [],
            'message' => 'ban lay du lieu thanh cong',
        ];

        $start = Carbon::parse($request->start)->toDateTimeString();
        $end = Carbon::parse($request->end)->toDateTimeString();

        $event = $this->getListingBookings($start, $end);
        
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
            $bookings->fill($request->only(['people', 'content', 'title']));
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
        $room_id = $request->room;
        $data = $this->checkRoomsIdNotIn($date['start'], $date['end'], $room_id, $room_id);

        if (!$data->count()) {
            $bookings = Booking::find($request->id);
            $bookings->fill($request->only(['people', 'content', 'title']));
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

    public function postDrag(PostDragRequest $request)
    {
        $date = $this->convertDatetime($request->start, $request->end);
        $room_id = $request->room;
        $data = $this->checkRoomsIdNotIn($date['start'], $date['end'], $room_id);

        if (!$data->count()) {
            $bookings = Booking::find($request->id);
           
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
            'data' => [],
            'message' => 'Success',
        ]);
    }

    public function _getAdd(Request $request)
    {

        // $start = Carbon::parse($request->start_at)->toDateTimeString();
        // $end = Carbon::parse($request->end_at)->toDateTimeString();

        // // lay tong so phong da dat trong khoang thoi gian
        // $data = $this->getTotalOfRoom($start, $end)->pluck('total', 'room_id')->toArray();

        // $rooms = Room::where('status', '0')->get();

        // foreach($rooms as $key => $room){
        //     // $room->quantity = 3;
        //     // $room->quantity_room_available = $room->quantity;

        //     // if(!empty($data[$room->id])){
        //     //     // so luong phong dang co, tru cho so luong da dat,
        //     //     // neu = 0, remove phong nay ra khoi danh sach
        //     //     // echo  $data[$room->id];
        //     //     $room->quantity_room_available = $room->quantity_room_available - $data[$room->id];
        //     //     if($room->quantity_room_available <= 0){
        //     //         //remove
        //     //         $rooms->splice($key, 1);
        //     //     }
        //     // }

        //     if(!empty($data[$room->id])){
        //         $rooms->splice($key, 1);
        //     }

        //     foreach ($hocphan as $hp )
        //     {
        //         echo "<option value='".$hp->id."'>".$hp->name."</option>";
        //     }
        // }

    }
}
