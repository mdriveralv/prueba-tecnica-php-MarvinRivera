<?php

namespace App\Tests\ValueObject;

use App\Exceptions\WeakPasswordException;
use App\ValueObject\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testCreacionYEncriptacionPassword()
    {
        $passwordAEvaluar = 'Pa$$w0rd10';
        $password = new Password($passwordAEvaluar);
        $this->assertEquals(true, password_verify($passwordAEvaluar, $password->getPassword()));
    }

    public function testExcepcionFormatoPasswordLongitud8Caracteres()
    {
        $passwordAEvaluar = 'Pa$$';
        $this->expectException(WeakPasswordException::class);
        $password = new Password($passwordAEvaluar);
    }

    public function testExcepcionFormatoPasswordAlMenosUnaLetraMayuscula()
    {
        $passwordAEvaluar = 'pa$$word10';
        $this->expectException(WeakPasswordException::class);
        $password = new Password($passwordAEvaluar);
    }

    public function testExcepcionFormatoPasswordAlMenosUnaLetraMinuscula()
    {
        $passwordAEvaluar = 'PA$$WORD10';
        $this->expectException(WeakPasswordException::class);
        $password = new Password($passwordAEvaluar);
    }

    public function testExcepcionFormatoPasswordAlMenosUnNumero()
    {
        $passwordAEvaluar = 'Pa$$word';
        $this->expectException(WeakPasswordException::class);
        $password = new Password($passwordAEvaluar);
    }

    public function testExcepcionFormatoPasswordAlMenosUnCaracterEspecial()
    {
        $passwordAEvaluar = 'PaSSw0rd10';
        $this->expectException(WeakPasswordException::class);
        $password = new Password($passwordAEvaluar);
    }
}
