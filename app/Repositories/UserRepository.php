<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected User $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
}
