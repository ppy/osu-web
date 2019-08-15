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
            <div class="supporter-status">
                <div class="supporter-status__pippi"></div>
                @if (!empty($supporterStatus))
                    <!-- supporter status  -->
                    <div class="supporter-status__flex-container">
                        <div class="supporter-heart{{ $supporterStatus['current'] ? ' supporter-heart--active' : '' }}"></div>
                        <div class="supporter-status__flex-container-inner">
                            <div class="supporter-status__title">
                                {{ trans('community.support.supporter_status.title') }}
                            </div>
                            <div class="supporter-status__progress-bar supporter-status__progress-bar--active">
                                <div class="supporter-status__progress-bar-fill supporter-status__progress-bar-fill--active" style="width: {{$supporterStatus['remainingRatio'] ?? 0}}%;"></div>
                            </div>
                            @if ($supporterStatus['expiration'] !== null)
                            <div class="supporter-status__text supporter-status__text--first">
                                {!! trans('community.support.supporter_status.'.($supporterStatus['current'] ? 'valid_until' : 'was_valid_until'), [
                                    'date' => '<strong>'.i18n_date($supporterStatus['expiration']).'</strong>'
                                ]) !!}
                            </div>
                            @else
                            <div class="supporter-status__text">
                                {!! trans('community.support.supporter_status.not_yet') !!}
                            </div>
                            @endif
                            @if ($supporterStatus['tags'] > 0)
                            <div class="supporter-status__text">
                                {!! trans('community.support.supporter_status.contribution', [
                                    'dollars' => "<strong>{$supporterStatus['dollars']}</strong>",
                                    'tags' => "<strong>{$supporterStatus['tags']}</strong>"
                                ]) !!}
                            </div>
                            @endif
                            @if ($supporterStatus['giftedTags'] > 0)
                            <div class="supporter-status__text">
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
        <div class="supporter-quote">
            <blockquote class="supporter-quote__content">
                "I've always tried to run osu! exactly how I'd want to see it run if I were a player. While this does mean osu! will never be a super-profitable business, that was never the goal (nor will it ever be!). We intentionally avoid advertising, partnerships, etc because I feel that would detract from the core experience.
                <br/><br/>
                osu! is free-to-win – supporting osu! won’t give you any competitive advantage (but it might make you cooler amongst your friends!). I am hugely grateful, and honestly astounded, that we have come this far purely on donations, but this is where we are! Your contributions cover completely our small team's salaries, licensing efforts via the Featured Artist program, prizes and funding for official tournaments, but most importantly make sure we have quality servers and bandwidth available around the globe.
                <br/><br/>
                I would like to offer thanks and gratitude on behalf of myself and the rest of the team, to those who have supported osu!.
                <br/><br/>
                You keep osu! running."
            </blockquote>
            <div class="supporter-quote__signature">— Dean "peppy" Herbert, creator of osu!</div>
        </div>
        <div class="supporter">
            <div class="supporter__block">
                <h3 class="supporter__title">
                    {{ trans('community.support.money_goes_where.title') }}
                </h3>

                <div class="supporter__perk">
                    @foreach($data['blocks'] as $name => $icons)
                        <div class="supporter-perk">
                            <div class="supporter-perk__icon">
                                <span class="fa-stack">
                                    <i class="fas fa-circle fa-stack-2x supporter-perk__icon-bg"></i>
                                    @foreach($icons as $icon)
                                        <i class="{{ $icon }} fa-stack-1x"></i>
                                    @endforeach
                                </span>
                            </div>

                            <div class="supporter-perk__text">
                                <h4 class="supporter-perk__title">
                                    {!! trans("community.support.money_goes_where.blocks.{$name}.title") !!}
                                </h4>
                                <p class="supporter-perk__content">
                                    {!! trans("community.support.money_goes_where.blocks.{$name}.body") !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="supporter__block supporter__block--image">
                <h3 class="supporter__title">
                    {{ trans('community.support.perks.title') }}
                </h3>
                <div class="supporter__perks">
                    @foreach($data['perks'] as $index => $group)
                        @switch ($group['type'])
                            @case('group')
                                <div class="supporter supporter--features">
                                    <div class="supporter__perk">
                                        @foreach($group['items'] as $perk => $icon)
                                            @if (strlen($perk) > 0)
                                                <div class="supporter-perk supporter-perk--feature{{$index == 0 ? ' supporter-perk--first' : ''}}">
                                                    <div class="supporter-perk__icon">
                                                        <span class="fa-stack">
                                                            <i class="fas fa-circle fa-stack-2x supporter-perk__icon-bg"></i>
                                                            <i class="{{ $icon }} fa-stack-1x"></i>
                                                        </span>
                                                    </div>
                                                    <div class="supporter-perk__text">
                                                        <h4 class="supporter-perk__title">
                                                            {{ trans('community.support.perks.'.$perk.'.title') }}
                                                        </h4>
                                                        <p class="supporter-perk__content">
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
                                <div class="supporter-perk--hero{{$index == 0 ? ' supporter-perk--first' : ''}}">
                                    <img
                                        class="supporter-perk__hero-image"
                                        src="{{$group['image']}}"
                                        srcSet="{{$group['image']}} 1x, {{retinaify($group['image'])}} 2x"
                                    />
                                    <div class="supporter-perk__meta">
                                        <div class="supporter-perk__icon">
                                            <span class="fa-stack">
                                                <i class="fas fa-circle fa-stack-2x supporter-perk__icon-bg"></i>
                                                <i class="{{$group['icon']}} fa-stack-1x"></i>
                                            </span>
                                        </div>
                                        <div class="supporter-perk__text">
                                            <h4 class="supporter-perk__title">
                                                {{ trans('community.support.perks.'.$group['name'].'.title') }}
                                            </h4>
                                            <p class="supporter-perk__content">
                                                {{ trans('community.support.perks.'.$group['name'].'.description') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @break
                            @case('image')
                            @case('image-flipped')
                                <div class="supporter-perk--big{{$group['type'] === 'image-flipped' ? ' supporter-perk--flipped' : ''}}{{$index == 0 ? ' supporter-perk--first' : ''}}">
                                    <div class="supporter-perk__image">
                                        <img
                                            src="{{$group['image']}}"
                                            srcSet="{{$group['image']}} 1x, {{retinaify($group['image'])}} 2x"
                                        />
                                    </div>
                                    <div class="supporter-perk__meta">
                                        <div class="supporter-perk__icon">
                                            <span class="fa-stack">
                                                <i class="fas fa-circle fa-stack-2x supporter-perk__icon-bg"></i>
                                                <i class="{{$group['icon']}} fa-stack-1x"></i>
                                            </span>
                                        </div>
                                        <div class="supporter-perk__text">
                                            <h4 class="supporter-perk__title">
                                                {{ trans('community.support.perks.'.$group['name'].'.title') }}
                                            </h4>
                                            <p class="supporter-perk__content">
                                                {{ trans('community.support.perks.'.$group['name'].'.description') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @break
                            @case('image-group')
                                <div class="supporter supporter--features-2">
                                    <div class="supporter__perk supporter__perk--imglist">
                                        @foreach($group['items'] as $name => $perk)
                                            @if (strlen($name) > 0)
                                                <div class="supporter-perk supporter-perk--feature supporter-perk--img{{$index == 0 ? ' supporter-perk--first' : ''}}">
                                                    <div class="supporter-perk__text">
                                                        <h4 class="supporter-perk__title">
                                                            {{ trans('community.support.perks.'.$name.'.title') }}
                                                        </h4>
                                                        <p class="supporter-perk__content">
                                                            {!! trans('community.support.perks.'.$name.'.description') !!}
                                                        </p>
                                                    </div>
                                                    <div class="supporter-perk__icon">
                                                        <span class="fa-stack">
                                                            <i class="fas fa-circle fa-stack-2x supporter-perk__icon-bg"></i>
                                                            <i class="{{ $perk['icon'] }} fa-stack-1x"></i>
                                                        </span>
                                                    </div>
                                                    <div class="supporter-perk__img">
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
            </div>
            <div class="supporter__block">
                <h3 class="supporter__title">
                    {{ trans('community.support.convinced.title') }}
                </h3>
            </div>
            <div class="supporter-eyecatch">
                <div class="supporter-eyecatch__box">
                    <a class="supporter-eyecatch__link" href="{{ route('store.products.show', 'supporter-tag') }}">
                        <div class="supporter-heart supporter-heart--larger supporter-heart--active"></div>
                    </a>
                    <div class="supporter-eyecatch__text supporter-eyecatch__text--main">
                        {{ trans('community.support.convinced.support') }}
                    </div>
                    <div class="supporter-eyecatch__text supporter-eyecatch__text--sub-1">
                        {{ trans('community.support.convinced.gift') }}
                    </div>
                    <div class="supporter-eyecatch__text supporter-eyecatch__text--sub-2">
                        {{ trans('community.support.convinced.instructions') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
