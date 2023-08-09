<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read string|null $content_html
 * @property string|null $content_markdown
 * @property Carbon|null $ended_at
 * @property-read string|null $ended_at_json
 * @property int $id
 * @property string $image_url
 * @property int $order
 * @property Carbon $started_at
 * @property-read string $started_at_json
 * @property string $url
 * @method static Builder default()
 */
class NewsAnnouncement extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $dates = ['ended_at', 'started_at'];

    public function scopeDefault(Builder $query): void
    {
        $now = Carbon::now();

        $query
            ->where('started_at', '<=', $now)
            ->where(function ($query) use ($now) {
                $query
                    ->where('ended_at', '>', $now)
                    ->orWhereNull('ended_at');
            })
            ->orderBy('order');
    }

    public function getAttribute($key)
    {
        return match ($key) {
            'content_markdown',
            'id',
            'image_url',
            'order',
            'url' => $this->getRawAttribute($key),

            'ended_at',
            'started_at' => $this->getTimeFast($key),

            'ended_at_json',
            'started_at_json' => $this->getJsonTimeFast($key),

            'content_html' => $this->getContentHtml(),
        };
    }

    private function getContentHtml(): ?string
    {
        return $this->content_markdown === null
            ? null
            : markdown($this->content_markdown);
    }
}
