{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $class = class_with_modifiers('beatmapset-cover', $modifiers);

    $isNsfw = $beatmapset->nsfw;
    if ($isNsfw) {
        $attributesBag = request()->attributes;
        $userShowNsfw = $attributesBag->get('user_beatmapset_show_nsfw');
        if ($userShowNsfw === null) {
            $user = auth()->user();
            $userShowNsfw = $user !== null
                ? ($user->userProfileCustomization ?? $user->userProfileCustomization()->make())->beatmapset_show_nsfw
                : false;
            $attributesBag->set('user_beatmapset_show_nsfw', $userShowNsfw);
        }
    }

    $style = !$isNsfw || $userShowNsfw
        ? css_var_2x('--bg', $beatmapset->coverURL($size))
        : '';
@endphp
<div class="{{ $class }}" style="{{ $style }}"></div>
