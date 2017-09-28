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

namespace App\Events\Fulfillment;

use App\Events\MessageableEvent;
use App\Libraries\ValidationErrors;

class ValidationFailedEvent implements MessageableEvent
{
    protected $sender;
    private $errors;
    private $customMessage;

    public function __construct($sender, ValidationErrors $errors, string $customMessage = null)
    {
        $this->customMessage = $customMessage;
        $this->sender = $sender;
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function toMessage()
    {
        $senderText = get_class_basename(get_class($this->sender));
        $customText = presence($this->customMessage) ? "`{$this->customMessage}`" : '';
        $className = get_class_basename(static::class);
        return "`{$className}` from `{$senderText}` {$customText}\n\t" . implode("\n\t", $this->getErrors()->allMessages());
    }
}
