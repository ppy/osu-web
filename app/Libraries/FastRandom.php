<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries;

use InvalidArgumentException;

/**
 * A fast PRNG used in the osu! client
 *
 * @see https://github.com/ppy/osu/blob/bf1c5a3b1f6d48a23a8ab89d90dfb4838def0911/osu.Game.Rulesets.Catch/MathUtils/FastRandom.cs osu!lazer implementation
 */
class FastRandom
{
    private $x;
    private $y = 842502087;
    private $z = -715159705;
    private $w = 273326509;

    /**
     * @param int $seed A 32-bit seed for the PRNG.
     */
    public function __construct(int $seed)
    {
        if (PHP_INT_SIZE > 4) {
            if ($seed < -0x80000000 || $seed > 0x7FFFFFFF) {
                throw new InvalidArgumentException('Seed must be between -2^31 and 2^31-1');
            }

            // Mask out high bits from two's complement
            $seed &= 0xFFFFFFFF;
            $this->z &= 0xFFFFFFFF;
        }

        $this->x = $seed;
    }

    public function nextDouble(): float
    {
        // WARNING: These results won't be exactly the same as the osu! client on PHP installations
        //          that aren't 64-bit due to less precision, but they'll be close
        static $intToReal = 1 / 0x80000000;

        return $intToReal * $this->nextInt31();
    }

    public function nextInt31(): int
    {
        return $this->nextInt32() & 0x7FFFFFFF;
    }

    public function nextInt32(): int
    {
        $t = $this->x ^ static::maskedLeftShift($this->x, 11);

        $this->x = $this->y;
        $this->y = $this->z;
        $this->z = $this->w;

        return $this->w = $this->w ^ static::logicalRightShift($this->w, 19) ^ $t ^ static::logicalRightShift($t, 8);
    }

    private static function logicalRightShift(int $number, int $shift): int
    {
        return ($number >> $shift) & (PHP_INT_MAX >> ($shift - 1));
    }

    private static function maskedLeftShift(int $number, int $shift): int
    {
        $shifted = $number << $shift;
        $phpIntBits = PHP_INT_SIZE * 8;

        if ($phpIntBits > 32) {
            $shifted &= PHP_INT_MAX >> ($phpIntBits - 33);
        }

        return $shifted;
    }
}
