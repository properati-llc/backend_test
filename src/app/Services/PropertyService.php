<?php

namespace App\Services;

use App\Models\Property;
use App\Services\Interfaces\PropertyInterface;
use Illuminate\Database\Eloquent\Collection;

class PropertyService implements PropertyInterface
{
    private Property $model;

    public function __construct(Property $property)
    {
        $this->model = $property;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getOne(int $id): object
    {
        return $this->model->find($id);
    }
}