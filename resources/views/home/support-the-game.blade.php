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
            <div class="support-status">
                <div class="support-status__pippi"></div>
                @if (!empty($supporterStatus))
                    <!-- supporter status  -->
                    <div class="support-status__flex-container">
                        <div class="support-heart{{ $supporterStatus['current'] ? ' support-heart--active' : '' }}"></div>
                        <div class="support-status__flex-container-inner">
                            <div class="support-status__title">
                                {{ trans('community.support.supporter_status.title') }}
                            </div>
                            <div class="support-status__progress-bar support-status__progress-bar--active">
                                <div class="support-status__progress-bar-fill support-status__progress-bar-fill--active" style="width: {{$supporterStatus['remainingRatio'] ?? 0}}%;"></div>
                            </div>
                            @if ($supporterStatus['expiration'] !== null)
                            <div class="support-status__text support-status__text--first">
                                {!! trans('community.support.supporter_status.'.($supporterStatus['current'] ? 'valid_until' : 'was_valid_until'), [
                                    'date' => '<strong>'.i18n_date($supporterStatus['expiration']).'</strong>'
                                ]) !!}
                            </div>
                            @else
                            <div class="support-status__text">
                                {!! trans('community.support.supporter_status.not_yet') !!}
                            </div>
                            @endif
                            @if ($supporterStatus['tags'] > 0)
                            <div class="support-status__text">
                                {!! trans('community.support.supporter_status.contribution', [
                                    'dollars' => "<strong>{$supporterStatus['dollars']}</strong>",
                                    'tags' => "<strong>{$supporterStatus['tags']}</strong>"
                                ]) !!}
                            </div>
                            @endif
                            @if ($supporterStatus['giftedTags'] > 0)
                            <div class="support-status__text">
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
        <div class="support-quote">
            <blockquote class="support-quote__content">
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
            <div class="support-quote__signature">— Dean "peppy" Herbert</div>
        </div>
        <div class="support">
            <h3 class="support__title">
                {{ trans('community.support.money_goes_where.title') }}
            </h3>

            <div class="support__perk">
                @foreach($data['blocks'] as $name => $icons)
                    <div class="support-perk">
                        <div class="support-perk__icon">
                            <span class="fa-stack">
                                <i class="fas fa-circle fa-stack-2x support-perk__icon-bg"></i>
                                @foreach($icons as $icon)
                                    <i class="{{ $icon }} fa-stack-1x"></i>
                                @endforeach
                            </span>
                        </div>

                        <div class="support-perk__text">
                            <h4 class="support-perk__title">
                                {!! trans("community.support.money_goes_where.blocks.{$name}.title") !!}
                            </h4>
                            <p class="support-perk__content">
                                {!! trans("community.support.money_goes_where.blocks.{$name}.body") !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="support support--big-feature">
            <h3 class="support__title">
                {{ trans('community.support.perks.title') }}
            </h3>
        </div>

        <div class="support__perks">
            @foreach($data['perks'] as $index => $group)
                @switch ($group['type'])
                    @case('group')
                        <div class="support support--features">
                            <div class="support__perk">
                                @foreach($group['items'] as $perk => $icon)
                                    @if (strlen($perk) > 0)
                                        <div class="support-perk support-perk--feature{{$index == 0 ? ' support-perk--first' : ''}}">
                                            <div class="support-perk__icon">
                                                <span class="fa-stack">
                                                    <i class="fas fa-circle fa-stack-2x support-perk__icon-bg"></i>
                                                    <i class="{{ $icon }} fa-stack-1x"></i>
                                                </span>
                                            </div>
                                            <div class="support-perk__text">
                                                <h4 class="support-perk__title">
                                                    {{ trans('community.support.perks.'.$perk.'.title') }}
                                                </h4>
                                                <p class="support-perk__content">
                                                    {!! trans('community.support.perks.'.$perk.'.description') !!}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @break
                    @case('hero')
                        <div class="support-perk--hero{{$index == 0 ? ' support-perk--first' : ''}}">
                            <img
                                class="support-perk__hero-image"
                                src="{{$group['image']}}"
                                srcSet="{{$group['image']}} 1x, {{retinaify($group['image'])}} 2x"
                            />
                            <div class="support-perk__meta">
                                <div class="support-perk__icon">
                                    <span class="fa-stack">
                                        <i class="fas fa-circle fa-stack-2x support-perk__icon-bg"></i>
                                        <i class="{{$group['icon']}} fa-stack-1x"></i>
                                    </span>
                                </div>
                                <div class="support-perk__text">
                                    <h4 class="support-perk__title">
                                        {{ trans('community.support.perks.'.$group['name'].'.title') }}
                                    </h4>
                                    <p class="support-perk__content">
                                        {{ trans('community.support.perks.'.$group['name'].'.description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @break
                    @case('image')
                    @case('image-flipped')
                        <div class="support-perk--big{{$group['type'] === 'image-flipped' ? ' support-perk--flipped' : ''}}{{$index == 0 ? ' support-perk--first' : ''}}">
                            <div class="support-perk__image">
                                <img
                                    src="{{$group['image']}}"
                                    srcSet="{{$group['image']}} 1x, {{retinaify($group['image'])}} 2x"
                                />
                            </div>
                            <div class="support-perk__meta">
                                <div class="support-perk__icon">
                                    <span class="fa-stack">
                                        <i class="fas fa-circle fa-stack-2x support-perk__icon-bg"></i>
                                        <i class="{{$group['icon']}} fa-stack-1x"></i>
                                    </span>
                                </div>
                                <div class="support-perk__text">
                                    <h4 class="support-perk__title">
                                        {{ trans('community.support.perks.'.$group['name'].'.title') }}
                                    </h4>
                                    <p class="support-perk__content">
                                        {{ trans('community.support.perks.'.$group['name'].'.description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @break
                    @case('image-group')
                        <div class="support support--features-2">
                            <div class="support__perk support__perk--imglist">
                                @foreach($group['items'] as $name => $perk)
                                    @if (strlen($name) > 0)
                                        <div class="support-perk support-perk--feature support-perk--img{{$index == 0 ? ' support-perk--first' : ''}}">
                                            <div class="support-perk__text">
                                                <h4 class="support-perk__title">
                                                    {{ trans('community.support.perks.'.$name.'.title') }}
                                                </h4>
                                                <p class="support-perk__content">
                                                    {!! trans('community.support.perks.'.$name.'.description') !!}
                                                </p>
                                            </div>
                                            <div class="support-perk__icon">
                                                <span class="fa-stack">
                                                    <i class="fas fa-circle fa-stack-2x support-perk__icon-bg"></i>
                                                    <i class="{{ $perk['icon'] }} fa-stack-1x"></i>
                                                </span>
                                            </div>
                                            <div class="support-perk__img">
                                                <img
                                                    src="{{$perk['image']}}"
                                                    srcSet="{{$perk['image']}} 1x, {{retinaify($perk['image'])}} 2x"
                                                />
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @break
                @endswitch
            @endforeach
        </div>
        <div class="support">
            <h3 class="support__title">
                {{ trans('community.support.convinced.title') }}
            </h3>
        </div>
        <div class="support support--convinced">
            <div class="support__box">
                <a class="support__link" href="{{ route('store.products.show', 'supporter-tag') }}">
                    <div class="support-heart support-heart--larger support-heart--active"></div>
                </a>

                <div class="support__run support__run--main">
                    {{ trans('community.support.convinced.support') }}
                </div>

                <div class="support__run support__run--sub-1">
                    {{ trans('community.support.convinced.gift') }}
                </div>
                <div class="support__run support__run--sub-2">
                    {{ trans('community.support.convinced.instructions') }}
                </div>
            </div>
        </div>
    </div>
@endsection
