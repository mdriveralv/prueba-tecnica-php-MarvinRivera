<?php

namespace App\Event;

use App\Entity\User;

class UserRegisteredEvent
{
    public readonly User $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }
}
