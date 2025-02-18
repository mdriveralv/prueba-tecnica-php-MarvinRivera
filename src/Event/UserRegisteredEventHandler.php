<?php

namespace App\Event;

use SplObserver;
use SplSubject;

class UserRegisteredEventHandler implements SplObserver
{

    public function update(SplSubject $subject): void
    {
        $usuario = $subject->getUsuario();
        $evento = new UserRegisteredEvent($usuario);
        $this->sendEmailUserRegistered($evento);
    }

    private function sendEmailUserRegistered(UserRegisteredEvent $evento): void
    {
        // log de eventos
        error_log("\nLog: Se ha enviado correo de confirmación de registro a la dirección de correo electrónico: {$evento->usuario->getEmail()}\n");
    }
}
