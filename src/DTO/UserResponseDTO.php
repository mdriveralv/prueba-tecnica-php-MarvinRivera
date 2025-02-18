<?php

namespace App\DTO;

use App\Entity\User;

class UserResponseDTO
{
    private int $id;
    private string $name;
    private string $email;

    public function __construct(User $usuario)
    {
        $this->id = $usuario->getUserId()->getUserId();
        $this->name = $usuario->getUsername();
        $this->email = $usuario->getEmail();
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->name,
            'email' => $this->email
        ];
    }

    public function repuestaJson()
    {
        return json_encode($this->toArray());
    }
}
