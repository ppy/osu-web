{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (Auth::check())
    <div class="js-react--ranking-user-filter u-contents">
        <div class="ranking-filter">
            <div class="ranking-filter__title">
                {{ osu_trans('rankings.filter.title') }}
            </div>
            <div class="sort">
                <div class="sort__items">
                    <button class="sort__item sort__item--button">{{ osu_trans('sort.all') }}</button>
                    <button class="sort__item sort__item--button">{{ osu_trans('sort.friends')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script id="json-user-filter" type="application/json">
        {!! json_encode([
            'current' => $filter,
        ]) !!}
    </script>
@endif
