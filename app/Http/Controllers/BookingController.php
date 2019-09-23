<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;

class BookingController extends Controller
{
    public function getIndex(){
        
        return view('booking.booking_index');
    }

    // public function getAdd(){
    //     $booking=new Booking;
    //     $booking
    // }

    public function getListing(Request $request){
        $start = $request->input('start');
        $start = date("Y-m-d H:i:s", $start);
        $response = [
            'error' => false, // if == true is function error, else false
            'data' => [],
            'message' => 'ban lay du lieu thanh cong'
        ];
        $event = [
            [
                'id' => '1',
                'title' => 'lich 1',
                'start_date' => '2019-09-23',
                'end_date' => '2019-09-25',

            ],
            [
                'id' => '2',
                'title' => 'lich 12',
                'start_date' => '2019-09-27',
                'end_date' => '2019-09-28',

            ],
            [
                'id' => '3',
                'title' => 'lich 123',
                'start_date' => '2019-09-15',
                'end_date' => '2019-09-19',

            ]
        ];
        $response['data'] = $event;
        return response()->json($response);
    }
}
