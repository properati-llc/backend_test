<?php

namespace App\Services;

use App\Models\Property;
use App\Services\Interfaces\PropertyInterface;
use Carbon\Carbon;
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

    public function getOne(int $id): ?object
    {
        return $this->model->find($id);
    }

    public function save(array $data, int $id = null): int
    {
        $data['updated_at'] = Carbon::now();
        
        if(!$id) {
            $data['created_at'] = Carbon::now();
            $data['purchased'] = false;
            $data['expired'] = false;

            $property = $this->model::create($data);
            $return = $property['id'];
        } else {
            $return = $this->model::where('id', $id)->update($data);
        }

        return $return;
    }

    public function delete($id): int
    {
        return $this->model->destroy($id);
    }
}