<?php

namespace App\Tests\UseCase;

use App\DTO\RegisterUserRequest;
use App\Exceptions\UserAlreadyExistsException;
use App\UseCase\RegisterUserUseCase;
use PHPUnit\Framework\TestCase;

class RegisterUserUseCaseTest extends TestCase
{
    public function testCreacionDeUsuarioUsandoCasoDeUso()
    {
        $registroCasoUso = new RegisterUserUseCase();
        $datosUsuario = new RegisterUserRequest('mdriveralv', 'micorreo@correo.com', 'Pa$$w0rd');
        try {
            $resultado = $registroCasoUso->saveUser($datosUsuario);
            $this->assertJson($resultado);
        } catch (UserAlreadyExistsException $e) {
            $this->assertInstanceOf(UserAlreadyExistsException::class, $e);
        }
    }
}
