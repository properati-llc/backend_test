<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ServiceInterface
{
    public function getAll(): Collection;
    public function getOne(int $id): object;
}