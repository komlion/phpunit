<?php

use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public function test()
    {
        $user = app\models\User::findIdentity(1);
    }
}
