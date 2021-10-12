<?php

namespace App\Http\Controllers\API;

use App\Events\BookingAddedNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Jobs\Booking\CreateBooking;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'user_id' => ['required', 'numeric', Rule::exists('users', 'id')],
            'available_date_id' => ['required', 'numeric', Rule::exists('available_dates', 'id')]
        ]);
        $attributes['booking_token'] = 123456;
        try {
            
            dispatch(new CreateBooking($attributes))->delay(now()->addSeconds(3));
            
            return response()->json([
                'success' => true,
                'message' => 'Booking Created!, Please wait for the confirmation message.'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
