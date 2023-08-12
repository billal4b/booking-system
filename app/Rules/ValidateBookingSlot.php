<?php

namespace App\Rules;

use App\Models\MeetingSchedule;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\InvokableRule;

class ValidateBookingSlot implements InvokableRule
{
    public function __construct(public $date,public $start_time,public $end_time)
    {

    }
    public function __invoke($attribute, $value, $fail)
    {
        $message ='';
        if(!$this->isSlotNotBackdated()){
            $message ='Date or time must be greater than now';
        }else if(!$this->isSlotValid($value)){
            $message ='End time must be greater than start time';
        }else if(!$this->isSlotAvailable($value)){
            $message ='Your selected slot is not available';
        }
        if(!empty($message)){
            $fail($message);
        }
    }
    protected function isSlotNotBackdated(): bool
    {
        $now = strtotime(date("Y-m-d H:i:s"));
        return strtotime($this->date.' '.$this->start_time) >  $now && strtotime($this->date.' '.$this->end_time) >  $now;
    }
    protected function isSlotValid(): bool
    {
       return strtotime($this->date.' '.$this->start_time) < strtotime($this->date.' '.$this->end_time);
    }
    protected function isSlotAvailable(): bool
    {
        $start_time = $this->date.' '.$this->start_time;
        $end_time = $this->date.' '.$this->end_time;
        $total = MeetingSchedule::
        where(function($query)use($start_time,$end_time){
            $query->where('start_time','>=',$start_time)
            ->where('start_time','<=',$end_time);
            // $query->where('end_time','>=',$self->start_time)
            // ->where('end_time','<=',$self->end_time);
        })
        ->orWhere(function($query)use($start_time,$end_time){
            $query->where('end_time','>=',$start_time)
            ->where('end_time','<=',$end_time);
        })
        ->count();
        if($total){
            return false;
        }
        return true;
    }
}
