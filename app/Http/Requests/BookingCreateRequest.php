<?php

namespace App\Http\Requests;

use App\Rules\ValidateBookingSlot;
use App\Http\Requests\ApiFormRequest;

class BookingCreateRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'meeting_title' => ['required','string',new ValidateBookingSlot($this->booking_date,$this->start_time,$this->end_time)],
            'description'  => 'nullable|string',
            'booking_date' => ['required'],
            'start_time' => 'required|unique:meeting_schedules,start_time',
           'end_time' => 'required|unique:meeting_schedules,end_time'

        ];
    }
}

