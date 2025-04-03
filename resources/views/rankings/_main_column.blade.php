{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $filter ??= null;
    $mode ??= default_mode();
    $sort ??= null;
    $type ??= 'performance';
    $variant ??= null;
@endphp
@if ($object instanceof App\Models\Country)
    <a
        class="ranking-page-table-main"
        href="{{ route('rankings', [
            'mode' => $mode,
            'type' => 'performance',
            'country' => $object->acronym,
        ]) }}"
    >
        <span class="ranking-page-table-main__flag">
            @include('objects._flag_country', [
                'country' => $object->acronym,
            ])
        </span>
        <span class="ranking-page-table-main__link">
            <span class="ranking-page-table-main__link-text">
                {{ $object->name }}
            </span>
        </span>
    </a>
@elseif ($object instanceof App\Models\Team)
    <a
        class="ranking-page-table-main"
        href="{{ route('teams.leaderboard', [
            'ruleset' => $mode,
            'sort' => $sort,
            'team' => $object,
        ]) }}"
    >
        <span class="ranking-page-table-main__flag">
            @include('objects._flag_team', ['team' => $object])
        </span>
        <span class="ranking-page-table-main__link">
            <span class="ranking-page-table-main__link-text">
                {{ $object->name }}
            </span>
        </span>
    </a>
@elseif ($object instanceof App\Models\User)
    <div class="ranking-page-table-main">
        <span class="ranking-page-table-main__flag">
            <a
                class="u-contents"
                href="{{ route('rankings', [
                    'mode' => $mode,
                    'sort' => $sort,
                    'type' => $type,

                    'country' => $object->country->acronym,
                    'filter' => $filter,
                    'variant' => $variant,
                ]) }}"
            >
                @include('objects._flag_country', [
                    'country' => $object->country,
                ])
            </a>
        </span>

        @if (($showTeam ?? true) && ($team = $object->team) !== null)
            <span class="ranking-page-table-main__flag">
                <a class="u-contents" href="{{ route('teams.show', $team) }}">
                    @include('objects._flag_team', compact('team'))
                </a>
            </span>
        @endif

        <a
            class="ranking-page-table-main__link js-usercard"
            data-tooltip-position="right center"
            data-user-id="{{ $object->getKey() }}"
            href="{{ route('users.show', ['user' => $object->getKey(), 'mode' => $mode]) }}"
        >
            <span class="ranking-page-table-main__flag">
                <span
                    class="avatar avatar--dynamic-size"
                    {!! background_image($object->user_avatar) !!}
                ></span>
            </span>
            <span class="ranking-page-table-main__link-text">
                {{ $object->username }}
            </span>
        </a>
    </div>
@else
    ???
@endif
