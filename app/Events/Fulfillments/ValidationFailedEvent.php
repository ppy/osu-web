<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
