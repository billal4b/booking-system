<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_title',
        'description',
        'booking_date',
        'start_time',
        'end_time',
    ];

    // protected $casts=[

    // ];
    public function getStartTimeAttribute($value)
    {

        return date('h:i A',strtotime($value));
    }
    public function getEndTimeAttribute($value)
    {

        return date('h:i A',strtotime($value));
    }
    // protected function startTime():Attribute{
    //     return Attribute::make(
    //         get: fn (string $value) => date('h:i A',$value),
    //     );
    // }
}
