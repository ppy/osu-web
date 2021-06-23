{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $group = $userGroup->group;
    $playmodes = $userGroup->playmodes;
    $hasPlaymodes = $playmodes !== null && count($playmodes) > 0;
    $tag = $group->hasListing() ? 'a' : 'div';
    $title = $group->group_name;

    if ($hasPlaymodes) {
        $playmodeNames = implode(', ', array_map(fn ($mode) => trans("beatmaps.mode.{$mode}"), $playmodes));
        $title .= " ({$playmodeNames})";
    }
@endphp

<{{ $tag }}
    class="{{ class_with_modifiers('user-group-badge', $modifiers ?? null) }}"
    data-label="{{ $group->short_name }}"
    title="{{ $title }}"
    style="{!! css_group_colour($group) !!}"

    @if ($tag === 'a')
        href="{{ route('groups.show', $group->getKey()) }}"
    @endif
>
    @if ($hasPlaymodes)
        <div class="user-group-badge__modes">
            @foreach ($playmodes as $playmode)
                <i class="fal fa-extra-mode-{{$playmode}}"></i>
            @endforeach
        </div>
    @endif
</{{ $tag }}>
