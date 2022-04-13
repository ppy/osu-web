{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $class = class_with_modifiers('beatmapset-cover', $modifiers);
    $attributesBag = request()->attributes;
    $userShowNsfw = $attributesBag->get('user_beatmapset_show_nsfw');
    if ($userShowNsfw === null) {
        $user = auth()->user();
        $userShowNsfw = ($user->userProfileCustomization ?? $user->userProfileCustomization()->make())->beatmapset_show_nsfw;
        $attributesBag->set('user_beatmapset_show_nsfw', $userShowNsfw);
    }
    $style = $userShowNsfw || !$beatmapset->nsfw
        ? css_var_2x('--bg', $beatmapset->coverURL($size))
        : '';
@endphp
<div class="{{ $class }}" style="{{ $style }}"></div>
