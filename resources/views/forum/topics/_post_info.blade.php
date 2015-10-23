{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<div class="hidden-xs">
    <div class="forum__poster-box" style="{{ user_colour_style($user->user_colour, "background-color") }}">
        @if ($user->hasProfile() === true)
            <div class="name forum__info-row">
                <a class="js-user--hover-card forum__poster-box__link" href="{{ route("users.show", $user) }}">
                    {{ $user->username }}
                </a>
            </div>

            @if ($user->user_avatar)
                <a href="{{ route("users.show", $user) }}" class="forum__info-row forum__avatar-container">
                    <div
                        class="avatar avatar--full"
                        style="background-image: url('{{ $user->user_avatar }}');"
                        title="{{ trans("users.show.avatar", ["username" => $user->username]) }}"
                    ></div>
                </a>
            @endif
        @else
            <div class="name forum__info-row">
                {{ $user->username }}
            </div>
        @endif

        @if($user->title() !== null)
            <div class="title forum__info-row">
                {{ $user->title() }}
            </div>
        @endif

        @if(count($user->flags()) > 0)
            <div class="forum__user-flags forum__info-row">
                @foreach ($user->flags() as $flagType => $flagValue)
                    @if ($flagType === "country")
                        <img
                            class="
                                forum__user-flag
                                forum__user-flag--country
                                {{ $options["large"] === true ? "forum__user-flag--large" : "" }}
                            "
                            src="/images/flags/{{ $flagValue[0] }}.png"
                            alt="{{ $flagValue[0] }}"
                            title="{{ $flagValue[1] }}"
                        />
                    @endif
                @endforeach
            </div>
        @endif
    </div>

    <div class="forum__poster-box--extra">
        @if($user->osu_subscriber)
            <div class="
                user-icon
                forum__user-icon--supporter
                {{ $options["large"] === true ? "forum__user-icon--large" : "" }}
            ">
                <i class="fa fa-heart"></i>
            </div>
        @endif
    </div>
</div>

<div class="visible-xs-flex user-data-sm" style="{{ user_colour_style($user->user_colour, "background-color") }}">
    @if ($user->user_avatar)
        <div
            class="avatar avatar--forum-small"
            style="background-image: url('{{ $user->user_avatar }}');"
            title="{{ trans("users.show.avatar", ["username" => $user->username]) }}"
        ></div>
    @endif

    <div class="main">
        <div class="name">
            <a class="forum__poster-box__link" href="{{ route("users.show", $user) }}">
                {{ $user->username }}
            </a>

            @if (isset($user->flags()["country"]) === true)
                <img
                    class="
                        forum__user-flag
                        forum__user-flag--country
                        forum__user-flag--small
                    "
                    src="/images/flags/{{ $user->flags()["country"][0] }}.png"
                    alt="{{ $user->flags()["country"][0] }}"
                    title="{{ $user->flags()["country"][1] }}"
                />
            @endif
        </div>

        @if($user->rank)
            <div class="title">
                {{ $user->rank->rank_title }}
            </div>
        @endif
    </div>

    @if($user->osu_subscriber)
        <div class="user-icon forum__user-icon--supporter">
            <i class="fa fa-heart"></i>
        </div>
    @endif
</div>
