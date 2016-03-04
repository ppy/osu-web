{{--
    Copyright 2015 ppy Pty. Ltd.

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
@extends("master")

@section("content")
    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="osu-page-header osu-page-header--slack">
            <div class="osu-page-header__title-box">
                <h2 class="osu-page-header__title osu-page-header__title--small">{{ trans('community.slack.header.small') }}</h2>
                <h1 class="osu-page-header__title">{{ trans('community.slack.header.large') }}</h1>
            </div>
        </div>
    </div>

    <div class="osu-layout__row osu-layout__row--page-compact">
        <div class="slack-content">
            <div class="slack-content__image-container slack-content__image-container--logo"><img class="slack-content__item slack-content__item--image" src="/images/layout/slack/slack-logo.png"/></div>
            <div class="slack-content__image-container slack-content__image-container--devices"><img class="slack-content__item slack-content__item--image" src="/images/layout/slack/slack-devices.png"/></div>
            <div class="slack-content__item slack-content__item--text">
                <p class="slack-content__invite-info">{{ trans('community.slack.receive-invite') }}</p>
                <p>{!! trans('community.slack.bullet-points', ['link' => config('slack.link')]) !!}</p>
            </div>
        </div>
        <div class="osu-layout__row js-react--slack-button-container"></div>
    </div>
@endsection

@section("script")
    <script data-turbolinks-eval="always">
        var accepted = {!! json_encode($accepted) !!};
        var isInviteAccepted = {!! json_encode($isInviteAccepted) !!};
        var isEligible = {!! json_encode($isEligible) !!};
        var supportMail = {!! json_encode($supportMail) !!};
    </script>

    <script src="{{ elixir("js/react/slack-page.js") }}" data-turbolinks-track></script>
@endsection
