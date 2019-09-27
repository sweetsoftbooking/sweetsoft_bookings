<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\GetRoomRequest;
use App\Http\Requests\PostBookingRequest;
use App\Room;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getIndex()
    {
        $rooms = Room::all();
        return view('booking.booking_index', compact('rooms'));
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
        $event = $this->getTotalOfRoom($start, $end);
        $response['data'] = $event;
        return response()->json($response);
    }

    public function getRoomInBooking($start, $end, $people = 0, $select = ['*'])
    {
        $data = Room::select($select)
        ->where('large', '>=' , $people)
            ->whereDoesntHave('bookings', function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
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
            })->get();
        return $data;

    }

    public function getTotalOfRoom($start, $end, $room_id = null)
    {
        $data = Booking::select(['id', 'from_datetime', 'to_datetime', 'title', 'room_id'])
                        ->with(['room:id,name']);
        if ($room_id) {
            $data = $data->where('room_id', $room_id);
        }

        $data = $data->where(function ($query) use ($start, $end) {
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
            })->get();
        return $data;
    }

    public function getRooms(GetRoomRequest $request)
    {   
        $people = $request->input('people');
        $start = Carbon::parse($request->start)->toDateTimeString();
        $end = Carbon::parse($request->end)->toDateTimeString();
        $data = $this->getRoomInBooking($start, $end, $people, ['id', 'name']);
        $response = [
            'error' => false,
            'message' => '',
            'data' => $data,
        ];
        return response()->json($response);
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

    public function postAdd(PostBookingRequest $request)
    {
        $date = $this->convertDatetime($request->start, $request->end);
        $room_id = $request->room;
        $data = $this->getTotalOfRoom($date['start'], $date['end'], $room_id);
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

    private function convertDatetime($start, $end){
        $start = Carbon::parse($start)->toDateTimeString();
        $end = Carbon::parse($end)->toDateTimeString();
        return [
            'start'=>$start,
            'end'=>$end
        ];
    }

}
