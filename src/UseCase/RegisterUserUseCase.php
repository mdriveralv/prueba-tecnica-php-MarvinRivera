<?php

namespace App\UseCase;

require_once 'bootstrap.php';

use App\DTO\RegisterUserRequest;
use App\DTO\UserResponseDTO;
use App\Event\UserRegisteredEventHandler;
use App\Exceptions\UserAlreadyExistsException;
use App\Entity\User;
use App\ValueObject\Email;
use App\ValueObject\Password;
use App\ValueObject\UserId;
use DateTimeImmutable;
use App\Model\DoctrineUserRepository;
use App\ValueObject\Username;

class RegisterUserUseCase
{
    private DoctrineUserRepository $repositorio;

    public function __construct()
    {
        $this->repositorio = new DoctrineUserRepository();
    }

    public function saveUser(RegisterUserRequest $request)
    {
        // Crear usuario
        $usuario = new User(
            null,
            new Username($request->name),
            new Email($request->email),
            new Password($request->password)
        );

        // Validar que Email no se encuentre en uso
        if (!empty($this->repositorio->findByEmail(new Email($request->email)))) {
            throw new UserAlreadyExistsException("El correo electronico {$request->email} ya ha sido registrado.");
        }

        // Suscribirse a evento
        $observador = new UserRegisteredEventHandler();
        $this->repositorio->attach($observador);

        // Guardar usuario
        $this->repositorio->save($usuario);

        // Generar respuesta Json hacia controlador
        $nuevoUsuario = new UserResponseDTO($usuario);
        return $nuevoUsuario->repuestaJson();
    }
}
