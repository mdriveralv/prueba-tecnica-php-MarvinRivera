<?php

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class UserId
{
    #[ORM\Id]
    #[ORM\Column(type: "integer", name: "id")]
    #[ORM\GeneratedValue("AUTO")]
    private ?int $id = null;

    public function __construct(int|null $id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->id;
    }
}
