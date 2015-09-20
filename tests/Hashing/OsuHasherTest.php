<?php

class OsuHasherTest extends PHPUnit_Framework_TestCase
{
    public function testBasicHashing()
    {
        $hasher = new App\Hashing\OsuHasher;
        $value = $hasher->make('password');
        $this->assertNotSame('password', $value);
        $this->assertNotSame(md5('password'), $value);

        $this->assertTrue($hasher->check('password', $value));
        $this->assertFalse($hasher->needsRehash($value));
        $this->assertTrue($hasher->needsRehash($value, ['cost' => 4]));
    }
}
