<?php

namespace App\Tests;

use App\Entity\Utilisateur;
use PHPUnit\Framework\TestCase;

class TestGetUsernameTest extends TestCase
{
    public function testSomething(): void
    {
        $user = new Utilisateur;
        $user->setUsername("test");
        self::assertEquals($user->getUserIdentifier(),"test");$this->assertTrue(true);
    }
}
