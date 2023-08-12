<?php

namespace App\Interfaces;
use Illuminate\Contracts\Pagination\Paginator;

interface BookingInterface
{
    public function getAll(): Paginator;

    public function create(array $data): object|null;

    public function getById(int $id): object|null;

    public function update(int $id, array $data): object|null;

    public function delete(int $id): object|null;

}
