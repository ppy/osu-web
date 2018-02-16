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
<div class="hidden-xs forum-post__info-panel" style="{{ user_color_style($user->user_colour, "background-color") }}">
    <div class="forum-post__info-panel-main">
        @if ($user->hasProfile() === true)
            @if ($user->user_avatar)
                <div class="avatar-ribbon avatar-ribbon--level-{{ $user->supportLevel() }}">
                    <a
                        href="{{ route("users.show", $user) }}"
                        class="avatar avatar--forum"
                        style="background-image: url('{{ $user->user_avatar }}');"
                    ></a>
                </div>
            @endif

            <a class="forum-post__username js-usercard" data-user-id="{{$user->user_id}}" href="{{ route("users.show", $user) }}">
                {{ $user->username }}
            </a>
        @else
            <span class="forum-post__username">
                {{ $user->username }}
            </span>
        @endif
    </div>

    <div class="forum-post__info-panel-extra">
        <div class="forum-post__info-panel-extra-top">
            @if($user->title() !== null)
                <div class="forum-post__info-row forum-post__info-row--user-title">
                    {{ $user->title() }}
                </div>
            @endif

            @if(count($user->flags()) > 0)
                <div class="forum__user-flags forum__info-row">
                    @foreach ($user->flags() as $flagType => $flagValue)
                        @if ($flagType === "country")
                            <a href="{{route('rankings', ['mode' => 'osu', 'type' => 'performance', 'country' => $flagValue[0]])}}">
                                <img
                                    class="forum__user-flag forum__user-flag--country"
                                    src="{{ flag_path($flagValue[0]) }}"
                                    alt="{{ $flagValue[0] }}"
                                    title="{{ $flagValue[1] }}"
                                />
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <div class="forum-post__info-panel-extra-bottom">
            <div class="forum-post__info-row">
                {!! display_regdate($user) !!}
            </div>
        </div>
    </div>
</div>

<div class="visible-xs">
    <div class="forum-post__info-panel-xs" style="{{ user_color_style($user->user_colour, "background-color") }}">
        @if ($user->user_avatar)
            <div class="avatar-ribbon
                avatar-ribbon--xs
                avatar-ribbon--level-{{ $user->supportLevel() }}"
            >
                <div
                    class="avatar avatar--forum-small"
                    style="background-image: url('{{ $user->user_avatar }}');"
                ></div>
            </div>
        @endif

        <div class="forum-post__info-panel-xs-main">
            <div class="forum-post__info-panel-xs-name">
                <a class="link--white" href="{{ route("users.show", $user) }}">
                    {{ $user->username }}
                </a>

                @if (isset($user->flags()["country"]) === true)
                    <span class="forum-post__info-panel-xs-flag">
                        <img
                            class="flag-country flag-country--small-box"
                            src="{{ flag_path($user->flags()['country'][0]) }}"
                            alt="{{ $user->flags()["country"][0] }}"
                            title="{{ $user->flags()["country"][1] }}"
                        />
                    </span>
                @endif
            </div>

            @if($user->title())
                <div class="forum-post__info-panel-xs-title">
                    {{ $user->title() }}
                </div>
            @endif
        </div>
    </div>
</div>
