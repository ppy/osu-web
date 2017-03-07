{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
@extends("master", ['body_additional_classes' => 'osu-layout--body-dark'])

@section("content")
    <div class="osu-page">
        <!-- header info -->
        <div class="stg-header">
            <h2 class="stg-header__header">
                {!! trans('community.support.header.big_description') !!}
            </h2>

            <p class="stg-header__description">
                {!! trans('community.support.header.small_description') !!}
            </p>

            <a class="stg-header__button" href="{{ osu_url('support-the-game') }}">
                {!! trans('community.support.header.support_button') !!}
                <span class="stg-header__button-icon">
                    <span class="fa fa-heart"></span>
                </span>
            </a>
        </div>
        <!-- end: header info -->
    </div>

    <div class="osu-page osu-page--small">
        <!-- quote -->
        <div class="stg-quote">
            <span class="stg-quote__bg">
                <span class="fa fa-quote-left"></span>
            </span>
            <blockquote class="stg-quote__content">
                "{!! trans('community.support.dev_quote') !!}"
            </blockquote>
            <div class="stg-quote__signature">— Dean "peppy" Herbert</div>
        </div>
        <!-- end: quote -->
    </div>

    <div class="osu-page osu-page--small osu-page--stg-block">
        <!-- why support  -->
        <div class="stg-block">
            <h3 class="stg-block__title">
                {{ trans('community.support.why_support.title') }}
            </h3>

            <div class="stg-block__perks">
                @foreach($data['blocks'] as $name => $icon)
                    <div class="stg-perk">
                        <div class="stg-perk__icon">
                            <span class="fa fa-{{ $icon }}"></span>
                        </div>

                        <div class="stg-perk__text">
                            {!! trans('community.support.why_support.blocks.'.$name) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end: why support -->


        <!-- what gets -->
        <div class="stg-block stg-block--features">
            <h3 class="stg-block__title">
                {{ trans('community.support.perks.title') }}
            </h3>

            <!-- preview -->
            <div class="stg-block__preview"></div>

            <div class="stg-block__perks">
                @foreach($data['perks'] as $name => $icon)
                    @if (strlen($name) > 0)
                        <div class="stg-perk stg-perk--feature">
                            <div class="stg-perk__icon">
                                <span class="fa fa-{{ $icon }}"></span>
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
        <!-- end: what gets -->

        <!-- convinced -->
        <div class="stg-block stg-block--convinced">
            <h3 class="stg-block__title">
                {{ trans('community.support.convinced.title') }}
            </h3>

            <a class="icon-fancy" href="{{ osu_url('support-the-game') }}">
                <span class="fa fa-heart"></span>
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
        <!-- end: convinced -->

    </div>
@endsection
