<?php

namespace App\Model;

require_once "bootstrap.php";

use App\Interface\UserRepositoryInterface;
use App\Entity\User;
use App\ValueObject\Email;
use App\ValueObject\Password;
use App\ValueObject\UserId;
use App\ValueObject\Username;
use Doctrine\ORM\EntityManagerInterface;
use SplObjectStorage;
use SplObserver;
use SplSubject;

class DoctrineUserRepository implements UserRepositoryInterface, SplSubject
{
    private SplObjectStorage $observadores;
    private User $usuario;
    private EntityManagerInterface $em;

    public function __construct()
    {
        $this->em = require 'bootstrap.php';
        $this->observadores = new SplObjectStorage();
    }

    public function findById(UserId $id): null|User
    {
        $dql = "SELECT * FROM users AS u WHERE id = :paramId";
        $resultset = $this->em->createQuery($dql)
            ->setParameter('paramId', $id)
            ->getSingleResult();

        return (
            new User(
                new UserId($resultset['id']),
                new Username($resultset['name']),
                new Email($resultset['email']),
                new Password($resultset['password']),
                $resultset['createdAt']
            )) ?? null;
    }

    public function findByEmail(Email $email)
    {
        $dql = "SELECT u FROM App\Entity\User u WHERE u.email = :email";
        return $this->em
            ->createQuery($dql)
            ->setParameter('email', $email->getEmail())
            ->getArrayResult();
    }

    public function save(User $usuario): void
    {
        $this->em->persist($usuario);
        $this->em->flush();
        $this->usuario = $usuario;
        $this->notify();
    }

    public function delete(UserId $id): void
    {
        $this->em->remove(
            $this->em->getReference(User::class, $id)
        );
        $this->em->flush();
    }

    /*
    Métodos de interfaz: SplSubject
    */
    public function attach(SplObserver $observer): void
    {
        $this->observadores->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observadores->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observadores as $observador) {
            $observador->update($this);
        }
    }

    public function getUsuario(): User|null
    {
        return $this->usuario;
    }
}
