<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserInterface
{
    private User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
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