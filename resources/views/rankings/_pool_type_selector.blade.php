{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Models\MatchmakingPool;
@endphp
<div class="page-tabs page-tabs--follows">
    @foreach(MatchmakingPool::TYPES as $tab)
        <a
            class="{{ class_with_modifiers('page-tabs__tab', ['active' => $tab === $params['poolType']]) }}"
            href="{{ route('rankings.matchmaking', [
                'poolType' => $tab,
                'mode' => $params['mode'] ?? default_mode(),
            ]) }}"
        >
            {{ osu_trans("rankings.matchmaking.pool_types.{$tab}") }}
        </a>
    @endforeach
</div>
