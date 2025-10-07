{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $class = class_with_modifiers('beatmapset-cover', $modifiers);

    $showVisual = true;
    $isAnimeCover = $beatmapset->anime_cover;
    $isNsfw = $beatmapset->nsfw;

    if ($isNsfw || $isAnimeCover) {
        $preferences = App\Models\UserProfileCustomization::forUser(Auth::user());
        $showVisual = (!$isNsfw || $preferences['beatmapset_show_nsfw'])
            && (!$isAnimeCover || $preferences['beatmapset_show_anime_cover']);
    }

    $style = $showVisual
        ? css_var_2x('--bg', $beatmapset->coverURL($size))
        : '';
@endphp
<div class="{{ $class }}" style="{{ $style }}"></div>
