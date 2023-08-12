<?php

namespace App\Repositories;

use Exception;
use App\Models\MeetingSchedule;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Interfaces\BookingInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Pagination\Paginator;


class BookingRepository implements BookingInterface
{

    public function getAll(): Paginator
    {
        return MeetingSchedule::orderBy('id', 'desc')->paginate(10);
    }

    public function create(array $data): ?MeetingSchedule
    {
        return MeetingSchedule::create($data);
    }

    public function getById(int $id): ?MeetingSchedule
    {
        $booking = MeetingSchedule::find($id);

        if(empty($booking)) {
           // throw new Exception("Booking does not exist.", Response::HTTP_NOT_EXTENDED);
            throw new Exception("Booking does not exist.", Response::HTTP_NOT_FOUND);
        }

        return $booking;
    }

    public function update(int $id, array $data): ?MeetingSchedule
    {
        $booking = $this->getById($id);
        $updated = $booking->update($data);

        if ($updated) {
            $booking = $this->getById($id);
        }

        return $booking;
    }

    public function delete(int $id): ?MeetingSchedule
    {
        $booking = $this->getById($id);

        $deleted = $booking->delete();

        if (!$deleted) {
            throw new Exception("Booking could not be deleted.", Response::HTTP_INTERNAL_SERVER_ERROR);
            // throw new Exception("Booking could not be deleted.", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $booking;
    }

}
