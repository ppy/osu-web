<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    public static function getDisplayName(Store\OrderItem $item, bool $html = false)
    {
        static $transKey = 'store.order.item.display_name.supporter_tag';

        $durationText = static::getDurationText((int) $item->extra_data['duration']);

        // test data didn't include username, so ?? ''
        $username = $item->extra_data['username'] ?? '';

        return $html
            ? blade_safe(osu_trans($transKey, [
                'duration' => e($durationText),
                'name' => e($item->product->name),
                'username' => link_to_user($item->extra_data['target_id'], $username),
            ])) : osu_trans($transKey, [
                'duration' => $durationText,
                'name' => $item->product->name,
                'username' => $username,
            ]);
    }

    public static function getDurationText($length, ?string $locale = null)
    {
        // don't forget to update StoreSupporterTagPrice.durationText in coffee
        $years = (int) ($length / 12);
        $months = $length % 12;
        $texts = [];

        if ($years > 0) {
            $texts[] = osu_trans_choice('common.count.years', $years, [], $locale);
        }

        if ($months > 0) {
            $texts[] = osu_trans_choice('common.count.months', $months, [], $locale);
        }

        return implode(', ', $texts);
    }
}
