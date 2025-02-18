<?php

namespace App\Controller;

use App\DTO\RegisterUserRequest;
use App\UseCase\RegisterUserUseCase;

class RegisterUserController
{
    public function index()
    {
        $peticion = $_SERVER['REQUEST_METHOD'];
        if ($peticion === 'POST') {
            return $this->registrarUsuario();
        }
    }

    private function registrarUsuario()
    {
        $datos = json_decode($_REQUEST['data']);
        $registrarUsuarioCasoUso = new RegisterUserUseCase();
        $datosUsuario = new RegisterUserRequest(
            $datos->name,
            $datos->email,
            $datos->password
        );

        return $registrarUsuarioCasoUso->saveUser($datosUsuario);
    }
}
