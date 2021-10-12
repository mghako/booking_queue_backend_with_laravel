<?php

namespace App\Services;

use App\Models\AvailableDate;

class CheckBookingLimit {
    public function check($available_date_id) {
        $availableDate = AvailableDate::findOrFail($available_date_id);

        if($availableDate->max_slots == $availableDate->booked_slots) {
            return false;
        }
        return true;
    }
}