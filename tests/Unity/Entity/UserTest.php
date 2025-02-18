<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\ValueObject\Email;
use App\ValueObject\Password;
use App\ValueObject\Username;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testCreacionDeUsuario()
    {
        $usuario = new User(
            null,
            new Username('mdriveralv'),
            new Email('micorreo@correo.com'),
            new Password('Pa$$w0rd')
        );

        // Prueba acceso a atributo nombre de usuario
        $this->assertEquals('mdriveralv', $usuario->getUsername());

        // Prueba acceso a atributo correo electrónico
        $this->assertEquals('micorreo@correo.com', $usuario->getEmail());

        // Prueba acceso a atributo contraseña
        $this->assertEquals(true, password_verify('Pa$$w0rd', $usuario->getPassword()));
    }
}
