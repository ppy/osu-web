<?php

namespace Tests\Controllers;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testBbcodePreview()
    {
        $text = 'test';

        $this
            ->post(route('bbcode-preview'), ['text' => 'test'])
            ->assertStatus(200);
    }

    public function testRoot()
    {
        $this
            ->get(route('home'))
            ->assertStatus(200);
    }
}
