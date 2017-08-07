<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Libraries\Commands;

use App\Libraries\Commands\Post\PostFulfillmentTask;

class FulfillmentContext
{
    private $post = [];

    public function getPostFulfillmentTasks()
    {
        return $this->post;
    }

    /**
     * Adds a post fulfillment task.
     *
     * Adds a post fulfillment task. The task's uniqueness is defined by its key().
     * The current implementation is last-added wins; future implementations may use a
     * combiner instead.
     * Tasks are currently only considered unique within a FulfillmentContext.
     */
    public function addPostFulfillmentTask(PostFulfillmentTask $task)
    {
        $this->post[$task->key()] = $task;
    }
}
