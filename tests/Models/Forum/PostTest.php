<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Forum;

use App\Models\Forum\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testPostTextPresenceCheck()
    {
        $post = new Post(['post_text' => 'this is a content']);

        $post->isValid();
        $this->assertFalse(isset($post->validationErrors()->all()['post_text']));
    }

    public function testPostTextPresenceCheckEmpty()
    {
        $post = new Post(['post_text' => '']);

        $post->isValid();
        $this->assertArrayHasKey('post_text', $post->validationErrors()->all());
        $this->assertStringContainsString('Post body is required', $post->validationErrors()->toSentence());
    }

    public function testPostTextPresenceCheckQuoteOnly()
    {
        $post = new Post(['post_text' => '[quote]this is a quote[/quote]']);

        $post->isValid();
        $this->assertArrayHasKey('base', $post->validationErrors()->all());
        $this->assertStringContainsString('Your reply contains only a quote', $post->validationErrors()->toSentence());
    }

    public function testPostTextSkipPresenceCheckEmpty()
    {
        $post = new Post(['post_text' => '']);
        $post->skipBodyPresenceCheck();

        $post->isValid();
        $this->assertFalse(isset($post->validationErrors()->all()['post_text']));
    }

    public function testPostTextSkipPresenceCheckQuoteOnly()
    {
        $post = new Post(['post_text' => '[quote]this is a quote[/quote]']);
        $post->skipBodyPresenceCheck();

        $post->isValid();
        $this->assertFalse(isset($post->validationErrors()->all()['post_text']));
    }
}
