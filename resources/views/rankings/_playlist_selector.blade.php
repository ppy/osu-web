{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Http\Controllers\RankingController;
@endphp
<div class="page-tabs page-tabs--follows">
    @foreach (['seasons', 'featured', 'charts'] as $tab)
        <a
            class="{{ class_with_modifiers('page-tabs__tab', ['active' => $tab === $params['list']]) }}"
            href="{{ RankingController::url([...$params, 'list' => $tab]) }}"
        >
            {{ osu_trans("rankings.playlists.{$tab}") }}
        </a>
    @endforeach
</div>
