<?php

namespace App\Tests\ValueObject;

use App\ValueObject\Email;
use PharIo\Manifest\InvalidEmailException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function testCreacionCorreoElectronico()
    {
        $email = new Email('micorreo@correo.com');
        $this->assertEquals('micorreo@correo.com', $email->getEmail());
    }

    public function testExcepcionFormatoDeCorreoElectronico()
    {
        $this->expectException(InvalidEmailException::class);
        new Email('micorreo#correo.com');
    }
}
