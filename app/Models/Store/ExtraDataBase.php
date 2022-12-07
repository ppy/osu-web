<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

abstract class ExtraDataBase
{
    public static function toExtraDataClass(OrderItem $model, array $data)
    {
        // TODO: The cast depends on product or product_id being set first.
        // This needs to be changed to not be dependant on the model.
        return match ($model->product->custom_class) {
            'supporter-tag' => new ExtraDataSupporterTag($data),
            'cwc-supporter',
            'mwc4-supporter',
            'mwc7-supporter',
            'owc-supporter',
            'twc-supporter' => new ExtraDataTournamentBanner($data),
            default => null,
        };
    }
}
