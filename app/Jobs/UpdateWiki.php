<?php

namespace App\Jobs;

use App\Libraries\OsuWiki;
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
            $status = $file['status'];

            $object = $this->getObject($file['filename']);

            if ($status === 'added' || $status === 'renamed') {
                // clearing out the cache for situations where something was cached
                // even when there was no page in git, eg. an english page for
                // a specific locale
                $object->forget();

                $object->get();
            }

            if ($status === 'renamed') {
                $this->getObject($file['previous_filename'])->forget();
            }

            if ($status === 'removed' || $status === 'modified') {
                $object->forget();
            }

            if ($status === 'modified') {
                $object->get();
            }
        }
    }

    /**
     * @return WikiObject
     */
    private function getObject($path)
    {
        $matches = [];

        // splits github path into wiki path, filename (locale in case of pages), file extension
        preg_match('/^(?:wiki\/)(.*)\/(.*)\.(.{2,})$/', $path, $matches);

        if (OsuWiki::isImage($path)) {
            $path = $matches[1].'/'.$matches[2].'.'.$matches[3];
            return new Image($path);
        } else {
            return new Page($matches[1], $matches[2]);
        }
    }
}
