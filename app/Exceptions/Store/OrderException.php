<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Exceptions\Store;

use App\Exceptions\HasExtraExceptionData;
use App\Libraries\ValidationErrors;
use App\Models\Store\Order;

class OrderException extends \Exception implements HasExtraExceptionData
{
    public function __construct(private ?Order $order, private ?ValidationErrors $errors = null, ?\Throwable $previous = null)
    {
        parent::__construct(previous: $previous);
    }

    public function getContexts(): array
    {
        return ['order' => $this->order?->only('id', 'provider', 'reference', 'status', 'transaction_id', 'user_id')];
    }

    public function getExtras(): array
    {
        return [
            'errors' => $this->errors?->all(),
        ];
    }
}
