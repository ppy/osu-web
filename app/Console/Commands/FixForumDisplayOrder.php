<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Forum\Forum;
use Illuminate\Console\Command;

class FixForumDisplayOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:forum-display-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Correctly sort forum based on parent tree.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = $this->confirm('Proceed?');

        if (!$continue) {
            $this->error('Aborted.');
            return;
        }

        $this->startReorder();
        $this->info('Done.');
    }

    public function startReorder()
    {
        $this->info('Preparing data...');

        $all = Forum::orderBy('left_id')->get();

        $byParentId = [];

        foreach ($all as $forum) {
            $byParentId[$forum->parent_id][] = $forum->getKey();
        }

        $sorted = [];
        $byId = $all->keyBy('forum_id');

        $this->info('Sorting...');

        $this->reorder($byParentId[0], $byParentId, $sorted, $byId);

        foreach ($sorted as $left => $forum) {
            $forum->update(['left_id' => $left * 10, 'right_id' => 0]);
        }
    }

    public function reorder($ids, $byParentId, &$sorted, &$byId)
    {
        foreach ($ids as $id) {
            $forum = $byId->pull($id);

            if ($forum === null) {
                continue;
            }

            $sorted[] = $forum;

            if (isset($byParentId[$id])) {
                $this->reorder($byParentId[$id], $byParentId, $sorted, $byId);
            }
        }
    }
}
