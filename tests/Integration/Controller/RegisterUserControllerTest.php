<?php

namespace App\Tests\Controller;

use App\Controller\RegisterUserController;
use App\Exceptions\UserAlreadyExistsException;
use PHPUnit\Framework\TestCase;

class RegisterUserControllerTest extends TestCase
{
    public function testRegistrarUsuarioSimulandoPeticionCliente()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_REQUEST['data'] = '{"name":"fapalacios", "email":"fapalacios@correo.com", "password":"Secure123$"}';
        $controlador = new RegisterUserController();

        try {
            $resultado = $controlador->index();
            $this->assertJson($resultado);
        } catch (UserAlreadyExistsException $e) {
            $this->assertInstanceOf(UserAlreadyExistsException::class, $e);
        }
    }
}
