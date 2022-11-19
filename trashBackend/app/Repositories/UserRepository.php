<?php

namespace App\Repositories;

use App\Models\User;

final class UserRepository extends AbstractEloquentRepository
{
    public function model(): string
    {
        return User::class;
    }
}
