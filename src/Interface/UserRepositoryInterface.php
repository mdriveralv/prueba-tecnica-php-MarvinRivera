<?php

namespace App\Interface;

use App\Entity\User;
use App\ValueObject\UserId;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findById(UserId $id): null|User;
    public function delete(UserId $id): void;
}
