<?php

namespace App\Entity;

use App\Model\DoctrineUserRepository;
use App\ValueObject\Email;
use App\ValueObject\Password;
use App\ValueObject\UserId;
use App\ValueObject\Username;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    //#[ORM\Column(name: "id")]
    #[ORM\Embedded("App\ValueObject\UserId")]
    private UserId|null $id;

    #[ORM\Embedded("App\ValueObject\Username")]
    #[ORM\Column(type: "string", length: 20, name: "name")]
    private Username $name;

    #[ORM\Embedded("App\ValueObject\Email")]
    #[ORM\Column(type: "string", length: 60, name: "email")]
    private Email $email;

    #[ORM\Embedded("App\ValueObject\Password")]
    #[ORM\Column(type: "string", length: 255, name: "password")]
    private Password $password;

    #[ORM\Column(type: "datetime", name: "createdAt")]
    private DateTime $createdAt;

    public function __construct(
        UserId|null $id,
        Username $name,
        Email $email,
        Password $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTime(); //Immutable();
    }

    public function getUserId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
