<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\BeatmapsetEvent;
use App\Models\BeatmapsetNomination;

$factory->define(BeatmapsetNomination::class, function () {
    // not setting any of the required values so they have to be explicitly specified.
    // event_id will be overwritten later.
    return ['event_id' => 0];
});

$factory->afterCreating(BeatmapsetNomination::class, function ($nomination) {
    $event = $nomination->beatmapset->events()->create([
        'comment' => isset($nomination->modes) ? ['modes' => $nomination->modes] : null,
        'type' => BeatmapsetEvent::NOMINATE,
        'user_id' => $nomination->user_id,
    ]);

    $nomination->update(['event_id' => $event->getKey()]);
});
