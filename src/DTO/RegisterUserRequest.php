<?php

namespace App\DTO;

class RegisterUserRequest
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(
        string $name,
        string $email,
        string $password
    ) {
        $this->name = trim($name);
        $this->email = trim($email);
        $this->password = trim($password);
    }
}
