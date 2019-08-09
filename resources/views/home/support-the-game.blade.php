{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('master', [
    'legacyNav' => false,
])

@section('content')
    <div class="header-v3 header-v3--supporter">
        <div class="header-v3__bg"></div>
        <div class="header-v3__overlay"></div>
        <div class="osu-page osu-page--header-v3">
            <div class="stg-status">
                <div class="stg-status__pippi"></div>
                @if (!empty($supporterStatus))
                <!-- supporter status  -->
                <div class="stg-status__flex-container">
                    <div class="stg-heart{{ $supporterStatus['current'] ? ' stg-heart--active' : '' }}"></div>
                    <div class="stg-status__flex-container-inner">
                        <div class="stg-status__title">
                            {{ trans('community.support.supporter_status.title') }}
                        </div>
                        <div class="stg-status__progress-bar stg-status__progress-bar--active">
                            <div class="stg-status__progress-bar-fill stg-status__progress-bar-fill--active" style="width: {{$supporterStatus['remainingRatio'] ?? 0}}%;"></div>
                        </div>
                        @if ($supporterStatus['expiration'] !== null)
                        <div class="stg-status__text stg-status__text--first">
                            {!! trans('community.support.supporter_status.'.($supporterStatus['current'] ? 'valid_until' : 'was_valid_until'), [
                                'date' => '<strong>'.i18n_date($supporterStatus['expiration']).'</strong>'
                            ]) !!}
                        </div>
                        @else
                        <div class="stg-status__text">
                            {!! trans('community.support.supporter_status.not_yet') !!}
                        </div>
                        @endif
                        @if ($supporterStatus['tags'] > 0)
                        <div class="stg-status__text">
                            {!! trans('community.support.supporter_status.contribution', [
                                'dollars' => "<strong>{$supporterStatus['dollars']}</strong>",
                                'tags' => "<strong>{$supporterStatus['tags']}</strong>"
                            ]) !!}
                        </div>
                        @endif
                        @if ($supporterStatus['giftedTags'] > 0)
                        <div class="stg-status__text">
                            {!! trans('community.support.supporter_status.gifted', [
                                'giftedDollars' => "<strong>{$supporterStatus['giftedDollars']}</strong>",
                                'giftedTags' => "<strong>{$supporterStatus['giftedTags']}</strong>"
                            ]) !!}
                        </div>
                        @endif
                    </div>
                </div>
                <!-- end: supporter status -->
                @endif
            </div>
            <ol class="page-mode-v2 page-mode-v2--breadcrumbs"></ol>
        </div>
    </div>

    <div class="osu-page osu-page--supporter">
        <div class="stg-quote">
            <blockquote class="stg-quote__content">
                "osu! is a completely free-to-play game, but running it is most definitely not so free.
                Between the cost of commissioning servers and high quality international bandwidth, the time spent maintaining the system and community,
                providing prizes for competitions, answering support questions and generally keeping people happy, osu! consumes quite a hefty amount of money!
                Oh, and don't forget the fact that we do it without any advertising or partnering with silly toolbars and the likes!
                <br/><br/>
                osu! is at the end of the day largely run by myself, to which you may know best as "peppy".
                I have had to quit my day job in order to keep up with osu!,
                and do at times struggle to maintain the standards I strive for.
                I would like to offer my personal thanks to those who have supported osu! thus far,
                and just as much to those who continue to support this amazing game and community into the future :)."
            </blockquote>
            <div class="stg-quote__signature">— Dean "peppy" Herbert</div>
        </div>
        <div class="stg-block">
            <h3 class="stg-block__title">
                {{ trans('community.support.money_goes_where.title') }}
            </h3>

            <div class="stg-block__perks">
                @foreach($data['blocks'] as $name => $icons)
                    <div class="stg-perk">
                        <div class="stg-perk__icon">
                            <span class="fa-stack">
                                <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                                @foreach($icons as $icon)
                                    <i class="{{ $icon }} fa-stack-1x"></i>
                                @endforeach
                            </span>
                        </div>

                        <div class="stg-perk__text">
                            <h4 class="stg-perk__title">
                                {!! trans("community.support.money_goes_where.blocks.{$name}.title") !!}
                            </h4>
                            <p class="stg-perk__content">
                                {!! trans("community.support.money_goes_where.blocks.{$name}.body") !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="stg-block stg-block--big-feature">
            <h3 class="stg-block__title">
                {{ trans('community.support.perks.title') }}
            </h3>
            <div class="stg-perk--big">
                <div class="stg-perk__direct"></div>
                <div class="stg-perk__meta">
                    <div class="stg-perk__icon">
                        <span class="fa-stack">
                            <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                            <i class="fas fa-search fa-stack-1x"></i>
                        </span>
                    </div>
                    <div class="stg-perk__text">
                        <h4 class="stg-perk__title">
                            {{ trans('community.support.perks.osu_direct.title') }}
                        </h4>
                        <p class="stg-perk__content">
                            {!! trans('community.support.perks.osu_direct.description') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="stg-block stg-block--features">
            <div class="stg-block__perks">
                @foreach($data['perks'] as $name => $icon)
                    @if (strlen($name) > 0)
                        <div class="stg-perk stg-perk--feature">
                            <div class="stg-perk__icon">
                                <span class="fa-stack">
                                    <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                                    <i class="{{ $icon }} fa-stack-1x"></i>
                                </span>
                            </div>
                            <div class="stg-perk__text">
                                <h4 class="stg-perk__title">
                                    {{ trans('community.support.perks.'.$name.'.title') }}
                                </h4>
                                <p class="stg-perk__content">
                                    {!! trans('community.support.perks.'.$name.'.description') !!}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="stg-perk--big stg-perk--flipped">
            <div class="stg-perk__filter"></div>
            <div class="stg-perk__meta">
                <div class="stg-perk__icon">
                    <span class="fa-stack">
                        <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                        <i class="fas fa-filter fa-stack-1x"></i>
                    </span>
                </div>
                <div class="stg-perk__text">
                    <h4 class="stg-perk__title">
                        {{ trans('community.support.perks.beatmap_filters.title') }}
                    </h4>
                    <p class="stg-perk__content">
                        {!! trans('community.support.perks.beatmap_filters.description') !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="stg-block stg-block--features">
            <div class="stg-block__perks">
                @foreach($data['perks2'] as $name => $icon)
                    @if (strlen($name) > 0)
                        <div class="stg-perk stg-perk--feature">
                            <div class="stg-perk__icon">
                                <span class="fa-stack">
                                    <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                                    <i class="{{ $icon }} fa-stack-1x"></i>
                                </span>
                            </div>
                            <div class="stg-perk__text">
                                <h4 class="stg-perk__title">
                                    {{ trans('community.support.perks.'.$name.'.title') }}
                                </h4>
                                <p class="stg-perk__content">
                                    {!! trans('community.support.perks.'.$name.'.description') !!}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="stg-perk--customisation">
            <div class="stg-perk__meta">
                <div class="stg-perk__icon">
                    <span class="fa-stack">
                        <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                        <i class="fas fa-image fa-stack-1x"></i>
                    </span>
                </div>
                <div class="stg-perk__text">
                    <h4 class="stg-perk__title">
                        {{ trans('community.support.perks.customisation.title') }}
                    </h4>
                    <p class="stg-perk__content">
                        {!! trans('community.support.perks.customisation.description') !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="stg-block stg-block--features-2">
            <div class="stg-block__perks stg-block__perks--imglist">
                @foreach($data['perks3'] as $name => $icon)
                    @if (strlen($name) > 0)
                        <div class="stg-perk stg-perk--feature stg-perk--img">
                            <div class="stg-perk__text">
                                <h4 class="stg-perk__title">
                                    {{ trans('community.support.perks.'.$name.'.title') }}
                                </h4>
                                <p class="stg-perk__content">
                                    {!! trans('community.support.perks.'.$name.'.description') !!}
                                </p>
                            </div>
                            <div class="stg-perk__icon">
                                <span class="fa-stack">
                                    <i class="fas fa-circle fa-stack-2x stg-perk__icon-bg"></i>
                                    <i class="{{ $icon }} fa-stack-1x"></i>
                                </span>
                            </div>
                            <div class="stg-perk__img stg-perk__img--{{$name}}"></div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="stg-block">
            <h3 class="stg-block__title">
                {{ trans('community.support.convinced.title') }}
            </h3>
        </div>
        <div class="stg-block stg-block--convinced">
            <div class="stg-block__box">
                <a class="stg-block__link" href="{{ route('store.products.show', 'supporter-tag') }}">
                    <div class="stg-heart stg-heart--larger stg-heart--active"></div>
                </a>

                <div class="stg-block__run stg-block__run--main">
                    {{ trans('community.support.convinced.support') }}
                </div>

                <div class="stg-block__run stg-block__run--sub-1">
                    {{ trans('community.support.convinced.gift') }}
                </div>
                <div class="stg-block__run stg-block__run--sub-2">
                    {{ trans('community.support.convinced.instructions') }}
                </div>
            </div>
        </div>
    </div>
@endsection
