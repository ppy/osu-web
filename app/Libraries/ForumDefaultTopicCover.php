<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use App\Models\Forum\TopicCover;
use App\Traits\Imageable;

class ForumDefaultTopicCover
{
    use Imageable;

    public $hash;
    public $ext;
    public $id;

    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->hash = $data['hash'] ?? null;
        $this->ext = $data['ext'] ?? null;
    }

    public function getMaxDimensions()
    {
        return TopicCover::MAX_DIMENSIONS;
    }

    public function getFileRoot()
    {
        return 'forum-default-topic-covers';
    }
}
