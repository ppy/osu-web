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

class SendEmail {

	/* Send email async.

	Usage:

		Queue::push("SendEmail", [
			"data" => [
				"username" => $username
			],
			"to" => $email,
			"subject" => trans("emails.forgot-username.subject"),
		], "email");
	*/
	public function fire($job, $data)
	{
		$subject = @$data["subject"];
		$view = $data["view"];
		$to = @$data["to"];
		$vars = @$data["data"] ?: [];

		if ($subject and $view and $to)
		{
			Mail::send($view, $vars, function($message)
			{
				$message->subject($subject);
				$message->to($to);
			});
		}
		else
		{
			sentry_log("Job Failed: SendEmail (to: $to; subject: $subject; view: $view)", "queue", Raven_Client::FATAL);
		}

		// remove the job from the queue
		$job->delete();
	}
}
