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

namespace App\Models;

class SupporterTag
{
    const MIN_DONATION = 4;
    const PRODUCT_CUSTOM_CLASS = 'supporter-tag';

    /**
     * Gets the duration for a donated amount.
     *
     * Gets the supporter tag duration for an amount donated.
     *
     * @param int $amount Amount to get the duration for.
     * @return int duration in months.
     * @throws Exception
     **/
    public static function getDuration(int $amount)
    {
        if ($amount < self::MIN_DONATION) {
            $minDonation = self::MIN_DONATION; // can't interpolate const :D
            throw new \Exception("amount must be >= {$minDonation}");
        }

        switch (true) {
            case $amount >= 26:
                return floor($amount / 26.0 * 12);
            case $amount >= 24:
                return 10;
            case $amount >= 22:
                return 9;
            case $amount >= 20:
                return 8;
            case $amount >= 16:
                return 6;
            case $amount >= 12:
                return 4;
            case $amount >= 8:
                return 2;
            case $amount >= 4:
                return 1;
            default:
                return 0;
        }
    }

    /**
     * Gets the minimum donation amount required for a given length of support.
     *
     * This function is currently unused but implemented for future reference.
     *
     * @param int $duration Duration to get the minimum amount for.
     * @return int Minimum donation required.
     * @throws Exception
     **/
    public static function getMinimumDonation(int $duration)
    {
        switch (true) {
            case $duration >= 12:
                return ceil($duration / 12.0 * 26);
            case $duration === 10:
                return 24;
            case $duration === 9:
                return 22;
            case $duration === 8:
                return 20;
            case $duration === 6:
                return 16;
            case $duration === 4:
                return 12;
            case $duration === 2:
                return 8;
            case $duration === 1:
                return 4;
        }

        throw new \Exception('not a valid duration.');
    }

    public static function getDurationText($length)
    {
        // don't forget to update StoreSupporterTagPrice.durationText in coffee
        $years = (int) ($length / 12);
        $months = $length % 12;
        $texts = [];

        if ($years > 0) {
            $texts[] = trans_choice('common.count.years', $years);
        }

        if ($months > 0) {
            $texts[] = trans_choice('common.count.months', $months);
        }

        return implode(', ', $texts);
    }
}
