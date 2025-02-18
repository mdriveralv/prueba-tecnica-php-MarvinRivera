<?php

namespace App\Tests\ValueObject;

use App\ValueObject\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    public function testEvaluarCreacionIdConValorNulo()
    {
        $id = new UserId(null);
        $this->assertEquals(true, is_null($id->getUserId()));
    }

    public function testEvaluarCreacionIdConValorDiferenteDeNulo()
    {
        $id = new UserId(10);
        $this->assertEquals(10, $id->getUserId());
    }
}
