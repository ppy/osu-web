<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\User;

use App\Libraries\ImageProcessor;
use App\Libraries\StorageUrl;
use App\Models\User;
use GdImage;

class AvatarHelper
{
    private const DISK = 'avatar';

    public static function detectAlpha(string $path): bool
    {
        $dim = read_image_properties($path);
        if ($dim === null || $dim[2] === IMAGETYPE_JPEG) {
            return false;
        }

        $image = open_image($path, $dim);
        if (!($image instanceof GdImage)) {
            return false;
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $trueColor = imageistruecolor($image);

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $color = imagecolorat($image, $x, $y);
                $alpha = $trueColor
                    ? ($color >> 24) & 0x7F
                    : (imagecolorsforindex($image, $color)['alpha'] ?? 0);

                if ($alpha > 0) {
                    imagedestroy($image);

                    return true;
                }
            }
        }

        imagedestroy($image);

        return false;
    }

    public static function set(User $user, ?\SplFileInfo $src): bool
    {
        $id = $user->getKey();
        $storage = storage_disk(static::DISK);
        $hasAlpha = false;

        if ($src === null) {
            $storage->delete($id);
        } else {
            $srcPath = $src->getRealPath();
            $processor = new ImageProcessor($srcPath, [256, 256], 100000);
            $processor->process();
            $hasAlpha = static::detectAlpha($srcPath);

            $storage->putFileAs('/', $src, $id, 'public');
            $entry = $id.'_'.time().'.'.$processor->ext();
        }

        cache_proxy_purge(StorageUrl::make(static::DISK, (string) $id));

        return $user->update([
            'has_alpha' => $hasAlpha,
            'user_avatar' => $entry ?? '',
        ]);
    }

    public static function url(User $user): string
    {
        $value = $user->getRawAttribute('user_avatar');

        return present($value)
            ? StorageUrl::make(static::DISK, strtr($value, '_', '?'))
            : $GLOBALS['cfg']['osu']['avatar']['default'];
    }
}
