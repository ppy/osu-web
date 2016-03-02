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
        <div class="slack-header">
            <div class="slack-header__text-container">
                <h2 class="slack-header__text slack-header__text--small">{{ trans('community.slack.header.small') }}</h2>
                <h1 class="slack-header__text slack-header__text--large">{{ trans('community.slack.header.large') }}</h1>
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
        <div class="osu-layout__row">
            <div class="slack-button-container">
                @if ($accepted === true || ($agree === true && $isEligible == true))
                    <p class="slack-button-container__accepted">{{ trans('community.slack.accepted') }}</p>
                @else
                    <p class="slack-button-container__issues
                              @if ($isEligible === true)
                                slack-button-container__issues--hidden
                              @endif">{!! trans('community.slack.recent-issues', ['mail' => config('osu.emails.account')]) !!}</p>
                    <form>
                        <input type="hidden" name="agree" value="1">
                        <button class="btn-osu slack-button-container__button {{ $isEligible === true ? 'btn-osu-default' : 'disabled' }}" type="submit" formaction="{{ route('slack') }}">{{ trans('community.slack.agree-button') }}</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
