<?php

/**
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
*/

namespace App\Listeners\Forum;

class MarkTopicRead
{
	public function markTopicRead($event)
	{
		$event->topic->markRead(
			$event->user,
			$event->post->post_time
		);
	}

	public function subscribe($events)
	{
		$events->listen(
			"App\Events\Forum\TopicWasViewed",
			"App\Listeners\Forum\MarkTopicRead@markTopicRead"
		);

		$events->listen(
			"App\Events\Forum\TopicWasReplied",
			"App\Listeners\Forum\MarkTopicRead@markTopicRead"
		);
	}
}
