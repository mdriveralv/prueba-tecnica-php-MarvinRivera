<?php

namespace App\Tests\ValueObject;

use App\Exceptions\InvalidUsernameFormat;
use App\ValueObject\Username;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{
    public function testCreacionNombreDeUsuario()
    {
        $nombreDeUsuarioEvaluar = 'mdriveralv';
        $username = new Username($nombreDeUsuarioEvaluar);
        $this->assertEquals($nombreDeUsuarioEvaluar, $username->getName());
    }

    public function testExcepcionNombreDeUsuarioLongitudMenor6Caracteres()
    {
        $nombreDeUsuarioEvaluar = 'mdri';
        $this->expectException(InvalidUsernameFormat::class);
        new Username($nombreDeUsuarioEvaluar);
    }

    public function testExcepcionNombreDeUsuarioUsaCaracteresEspeciales()
    {
        $nombreDeUsuarioEvaluar = 'mdriver@lv';
        $this->expectException(InvalidUsernameFormat::class);
        new Username($nombreDeUsuarioEvaluar);
    }
}
