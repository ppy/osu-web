<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Jobs;

use App\Libraries\OsuWiki;
use App\Libraries\WikiRedirect;
use App\Models\NewsPost;
use App\Models\Wiki\Image;
use App\Models\Wiki\Page;
use App\Models\Wiki\WikiObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class UpdateWiki implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /** @var string */
    private $oldHash;

    /** @var string */
    private $newHash;

    /**
     * Create a new job instance.
     *
     * @param string $oldHash
     * @param string $newHash
     * @return void
     */
    public function __construct($oldHash, $newHash)
    {
        $this->oldHash = $oldHash;
        $this->newHash = $newHash;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $files = OsuWiki::getUpdatedFiles($this->oldHash, $this->newHash);

        foreach ($files as $file) {
            if ($file['status'] === 'renamed') {
                optional($this->getObject($file['previous_filename']))->sync(true);
            }

            optional($this->getObject($file['filename']))->sync(true);
        }
    }

    /**
     * @return WikiObject|null
     */
    private function getObject($path)
    {
        $parsed = OsuWiki::parseGithubPath($path);

        if ($parsed['type'] === 'page') {
            return Page::lookup($parsed['path'], $parsed['locale']);
        } elseif ($parsed['type'] === 'image') {
            return new Image($parsed['path']);
        } elseif ($parsed['type'] === 'redirect') {
            return new WikiRedirect();
        } elseif ($parsed['type'] === 'news_post') {
            return NewsPost::lookup($parsed['slug']);
        }
    }
}
