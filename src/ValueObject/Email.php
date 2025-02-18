<?php

namespace App\ValueObject;

use PharIo\Manifest\InvalidEmailException;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Email
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException("El correo electrónico {$email} proporcionado no posee un formato válido");
        }

        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->email;
    }
}
