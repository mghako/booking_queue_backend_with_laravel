<?php

namespace App\Jobs\Booking;

use App\Events\BookingAddedNotification;
use App\Models\Booking;
use App\Models\AvailableDate;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attributes;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            Booking::firstOrCreate($this->attributes);

            $availableDate = AvailableDate::findOrFail($this->attributes['available_date_id']);
            $availableDate->increment('booked_slots');
            $availableDate->push();
            DB::commit();
            event(new BookingAddedNotification("Booking Success!"));
            
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
