<?php

namespace App\ValueObject;

use App\Exceptions\InvalidUsernameFormat;
use Stringable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Username
{
    private string $name;

    public function __construct(string $name)
    {
        if (!preg_match("/^[0-9A-Za-z]{6,20}$/", $name)) {
            throw new InvalidUsernameFormat("El nombre de usuario debe tener entre 6 y 20 caracteres y solo puede
            incluir letras minúsculas, mayúsculas y números");
        }

        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->name;
    }
}
