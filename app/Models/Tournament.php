<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Models\Store\Product;
use Carbon\Carbon;

/**
 * @property \Carbon\Carbon|null $created_at
 * @property string $description
 * @property \Carbon\Carbon $end_date
 * @property string|null $header_banner
 * @property string|null $info_url
 * @property string $name
 * @property int $play_mode
 * @property \Illuminate\Database\Eloquent\Collection $profileBanners ProfileBanner
 * @property int|null $rank_max
 * @property int|null $rank_min
 * @property \Illuminate\Database\Eloquent\Collection $registrations TournamentRegistration
 * @property \Carbon\Carbon $signup_close
 * @property \Carbon\Carbon $signup_open
 * @property \Carbon\Carbon $start_date
 * @property int|null $tournament_banner_product_id
 * @property int $tournament_id
 * @property \Carbon\Carbon|null $updated_at
 */
class Tournament extends Model
{
    protected $primaryKey = 'tournament_id';

    protected $dates = ['signup_open', 'signup_close', 'start_date', 'end_date'];

    public static function getGroupedListing()
    {
        $tournaments = static::query()
            ->with('registrations')
            ->orderBy('tournament_id', 'desc')
            ->get();

        $now = Carbon::now();

        return [
            'current' => $tournaments->where('end_date', '>', $now),
            'previous' => $tournaments->where('end_date', '<=', $now),
        ];
    }

    public function profileBanners()
    {
        return $this->hasMany(ProfileBanner::class);
    }

    public function registrations()
    {
        return $this->hasMany(TournamentRegistration::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'tournament_banner_product_id');
    }

    public function isRegistrationOpen()
    {
        $now = Carbon::now();

        return $this->signup_open < $now && $this->signup_close > $now;
    }

    public function isTournamentRunning()
    {
        $now = Carbon::now();

        return $this->start_date < $now && $this->end_date > $now;
    }

    public function isStoreBannerAvailable()
    {
        return $this->tournament_banner_product_id !== null && $this->product->isAvailable();
    }

    public function isSignedUp($user)
    {
        if (!$user) {
            return false;
        }

        return $this->registrations()->where('user_id', '=', $user->user_id)->exists();
    }

    public function isValidRank($user)
    {
        if (!$user) {
            return false;
        }

        $userRank = UserStatistics\Model
            ::getClass($this->playModeStr(), $this->play_mode_variant)
            ::firstOrNew(['user_id' => $user->getKey()])
            ->globalRank();

        if ($this->rank_min !== null && ($userRank === null || $this->rank_min > $userRank)) {
            return false;
        }

        if ($this->rank_max !== null && ($userRank === null || $this->rank_max < $userRank)) {
            return false;
        }

        return true;
    }

    public function unregister($user)
    {
        //sanity check: we shouldn't be touching users once the tournament is already in action.
        if ($this->isTournamentRunning()) {
            return;
        }

        $this->registrations()->where('user_id', '=', $user->user_id)->delete();
    }

    public function register($user)
    {
        if ($this->isSignedUp($user)) {
            return;
        }

        //sanity check: we shouldn't be touching users once the tournament is already in action.
        if ($this->isTournamentRunning()) {
            return;
        }

        $reg = new TournamentRegistration();
        $reg->user()->associate($user);

        $this->registrations()->save($reg);
    }

    public function playModeStr()
    {
        return Beatmap::modeStr($this->play_mode);
    }

    public function pageLinks()
    {
        $links = [];

        if ($this->info_url !== null) {
            $links[] = [
                'url' => $this->info_url,
                'title' => osu_trans('tournament.show.info_page'),
            ];
        }

        if ($this->isStoreBannerAvailable()) {
            $links[] = [
                'url' => route('store.products.show', $this->tournament_banner_product_id),
                'title' => osu_trans('tournament.show.banner'),
            ];
        }

        return $links;
    }
}
