<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Transformers;

use App\Models\ProfileBanner;

class ProfileBannerTransformer extends TransformerAbstract
{
    public function transform(ProfileBanner $banner)
    {
        $image = $banner->image();
        $image2x = $image === null ? null : retinaify($image);

        return [
            'id' => $banner->getKey(),
            'tournament_id' => $banner->tournament_id,
            'image' => $image,
            'image@2x' => $image2x,
        ];
    }
}
