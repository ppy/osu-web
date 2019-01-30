<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Events\Fulfillments;

use App\Events\MessageableEvent;
use App\Libraries\ValidationErrors;
use Illuminate\Queue\SerializesModels;

class ValidationFailedEvent implements MessageableEvent
{
    use SerializesModels;

    protected $context = [];
    protected $errors;
    protected $senderClass;

    public function __construct($sender, ValidationErrors $errors)
    {
        $this->senderClass = get_class_basename(get_class($sender));
        $this->errors = $errors;
    }

    public function getErrors(): ValidationErrors
    {
        return $this->errors;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function toMessage()
    {
        $className = get_class_basename(static::class);
        $messages = implode("\n\t", $this->getErrors()->allMessages());

        return "`{$className}` from `{$this->senderClass}`\n\t{$messages}";
    }
}
