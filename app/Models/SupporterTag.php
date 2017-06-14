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
    /**
     * Checks if the amount to be donated is valid for the duration specified.
     *
     * @param int $value Amount of the donation to check.
     * @param int $duration Duration to check the donation against.
     * @return bool true if the amount is valid; false, otherwise.
     * @throws Exception
     **/
    public static function checkPrice(int $value, int $duration) {
        $required = self::getMinimumDonation($duration);

        return $required <= $value;
    }

    /**
     * Gets the duration for a donated amount.
     *
     * Gets the supporter tag duration for an amount donated.
     *
     * @param int $amount Amount to get the duration for.
     * @return int duration in months.
     **/
    public static function getDuration(int $amount) {
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
     * @param int $duration Duration to get the minimum amount for.
     * @return int Minimum donation required.
     * @throws Exception
     **/
    private static function getMinimumDonation(int $duration) {
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
}
