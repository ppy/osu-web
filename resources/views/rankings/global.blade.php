{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('rankings.index')

@section('ranking-header')
    <div class="osu-page osu-page--ranking-info">
        <div class="grid-items grid-items--ranking-filter">
            @include('rankings._country_filter')

            @include('rankings._user_filter')

            @php
                $variants = App\Models\Beatmap::VARIANTS[$params['mode']] ?? null;
                if ($variants !== null) {
                    array_unshift($variants, 'all');
                }
            @endphp
            @if ($variants !== null)
                <div class="js-react u-contents" data-react="ranking-variant-filter">
                    <div class="ranking-filter">
                        <div class="ranking-filter__title">
                            {{ osu_trans('rankings.filter.variant.title') }}
                        </div>
                        <div class="sort sort--ranking-header">
                            <div class="sort__items">
                                @foreach ($variants as $v)
                                    <button class="sort__item sort__item--button">
                                        {{ osu_trans("beatmaps.variant.{$params['mode']}.{$v}") }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <script id="json-variant-filter" type="application/json">
                    {!! json_encode([
                        'current' => $params['variant'],
                        'current_ruleset' => $params['mode'],
                        'items' => $variants,
                    ]) !!}
                </script>
            @endif
        </div>
    </div>
@endsection

@section('scores-header')
    <div class="sort">
        <div class="sort__items">
            <div class="sort__item sort__item--title">
                {{ osu_trans('sort._') }}
            </div>
            @foreach ([['performance', 'performance'], ['score', 'ranked_score']] as $newSort)
                <a
                    class="{{ class_with_modifiers('sort__item', 'button', ['active' => $newSort[0] === $params['sort']]) }}"
                    href="{{ route('rankings', [...$params, 'sort' => $newSort[0]]) }}"
                >
                    {{ osu_trans("rankings.stat.{$newSort[1]}") }}
                </a>
            @endforeach
        </div>
    </div>
@endsection

@section('scores')
    <table class="ranking-page-table">
        <thead>
            <tr>
                <th></th>
                @if ($showRankChange)
                    <th></th>
                @endif
                <th class="ranking-page-table__heading ranking-page-table__heading--main"></th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.accuracy') }}
                </th>
                <th class="ranking-page-table__heading">
                    {{ osu_trans('rankings.stat.play_count') }}
                </th>
                <th class="{{ class_with_modifiers(
                    'ranking-page-table__heading',
                    ['focused' => $params['sort'] === 'score'],
                ) }}">
                    {{ osu_trans('rankings.stat.ranked_score') }}
                </th>
                <th class="{{ class_with_modifiers(
                    'ranking-page-table__heading',
                    ['focused' => $params['sort'] === 'performance'],
                ) }}">
                    {{ osu_trans('rankings.stat.performance') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ osu_trans('rankings.stat.ss') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ osu_trans('rankings.stat.s') }}
                </th>
                <th class="ranking-page-table__heading ranking-page-table__heading--grade">
                    {{ osu_trans('rankings.stat.a') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $firstItem = $scores->firstItem();
            @endphp
            @foreach ($scores as $index => $score)
                <tr class="{{ class_with_modifiers('ranking-page-table__row', ['inactive' => !$score->user->isActive()]) }}">
                    <td class="ranking-page-table__column">
                        #{{ i18n_number_format($firstItem + $index) }}
                    </td>
                    @if ($showRankChange)
                        @php
                            $rankChange = $score->rankHistory?->rankChangeSince30Days();
                            $modifier = 'rank-change-'.match (true) {
                                $rankChange === null => 'pending',
                                $rankChange > 0 => 'down',
                                $rankChange < 0 => 'up',
                                default => 'none',
                            };
                        @endphp
                        <td
                            class="{{ class_with_modifiers('ranking-page-table__column', ['rank-change', $modifier]) }}"
                            @if ($rankChange === null)
                                title="{{ osu_trans('rankings.performance.insufficient_history') }}"
                            @endif
                        >
                            @if ($rankChange !== null && $rankChange !== 0)
                                {{ i18n_number_format(abs($rankChange)) }}
                            @endif
                        </td>
                    @endif
                    <td class="ranking-page-table__column ranking-page-table__column--main">
                        @include('rankings._main_column', ['object' => $score->user])
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ format_percentage($score->accuracy_new / 100) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format($score->playcount) }}
                    </td>
                    <td class="{{ class_with_modifiers(
                        'ranking-page-table__column',
                        ['dimmed' => $params['sort'] !== 'score'],
                    ) }}">
                        {{ i18n_number_format(round($score->ranked_score)) }}
                    </td>
                    <td class="{{ class_with_modifiers(
                        'ranking-page-table__column',
                        ['dimmed' => $params['sort'] !== 'performance'],
                    ) }}">
                        {{ i18n_number_format(round($score->rank_score)) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format(max(0, $score->x_rank_count + $score->xh_rank_count)) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format(max(0, $score->s_rank_count + $score->sh_rank_count)) }}
                    </td>
                    <td class="ranking-page-table__column ranking-page-table__column--dimmed">
                        {{ i18n_number_format(max(0, $score->a_rank_count)) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
