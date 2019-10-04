<?php

namespace Tests\Hashing;

use App\Hashing\OsuHasher;
use Illuminate\Contracts\Hashing\Hasher;
use PHPUnit\Framework\TestCase;

class OsuHasherTest extends TestCase
{
    public function testBasicHashing()
    {
        $hasher = new OsuHasher;
        $value = $hasher->make('password');
        $this->assertNotSame('password', $value);
        $this->assertNotSame(md5('password'), $value);

        $this->assertTrue($hasher->check('password', $value));
        $this->assertFalse($hasher->needsRehash($value));
        $this->assertTrue($hasher->needsRehash($value, ['cost' => 4]));
    }

    public function testImplementsHasher()
    {
        $hasher = new OsuHasher;
        $this->assertInstanceOf(Hasher::class, $hasher);
    }
}
