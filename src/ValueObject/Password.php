<?php

namespace App\ValueObject;

use App\Exceptions\WeakPasswordException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Password
{
    private string $password;

    public function __construct(string $password)
    {
        if (!$this->validarPassword($password)) {
            throw new WeakPasswordException("La contraseña debe tener un mínimo de 8 caracteres entre los cuales ´
            debe poseer al menos una letra mayúscula, un número y un carácter especial");
        }

        $this->password = $this->encriptarPassword($password);
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function validarPassword(string $password): bool
    {
        return (
            preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $password)
        );
    }

    private function encriptarPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function __toString()
    {
        return $this->password;
    }
}
