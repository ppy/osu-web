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
<div class="hidden-xs forum-post-info">
    @if ($user->hasProfile())
        @if ($user->user_avatar)
            <div class="forum-post-info__row forum-post-info__row--avatar">
                <a
                    href="{{ route("users.show", $user) }}"
                    class="avatar avatar--forum"
                    style="background-image: url('{{ $user->user_avatar }}');"
                ></a>
            </div>
        @endif

        @if ($user->supportLevel() > 0)
            <div class="forum-post-info__row forum-post-info__row--support-level">
                @for ($i = 0; $i < $user->supportLevel(); $i++)
                    <span class="fas fa-heart"></span>
                @endfor
            </div>
        @endif

        <a
            class="forum-post-info__row forum-post-info__row--username js-usercard"
            data-user-id="{{$user->user_id}}"
            href="{{ route("users.show", $user) }}"
        >{{ $user->username }}</a>
    @else
        <span class="forum-post-info__row forum-post-info__row--username">
            {{ $user->username }}
        </span>
    @endif

    @if ($user->title() !== null)
        <div class="forum-post-info__row">
            <div class="forum-user-badge">
                {{ $user->title() }}
            </div>
        </div>
    @endif

    @if ($user->country !== null)
        <div class="forum-post-info__row">
            <a href="{{route('rankings', ['mode' => 'osu', 'type' => 'performance', 'country' => $user->country->getKey()])}}">
                <img
                    class="flag-country"
                    src="{{ flag_path($user->country->getKey()) }}"
                    alt="{{ $user->country->getKey() }}"
                    title="{{ $user->country->name }}"
                />
            </a>
        </div>
    @endif

    @if ($user->getKey() !== null)
        <div class="forum-post-info__row forum-post-info__row--posts">
            <a class="link link--default" href="{{ route("users.posts", $user) }}">
                {{ trans_choice('forum.post.info.post_count', $user->user_posts) }}
            </a>
        </div>

        <div class="forum-post-info__row forum-post-info__row--registration">
            {!! display_regdate($user) !!}
        </div>
    @endif
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
                <a class="forum-post__user-link-xs" href="{{ route("users.show", $user) }}">
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

            @if ($user->title())
                <div class="forum-post__info-panel-xs-title">
                    {{ $user->title() }}
                </div>
            @endif
        </div>
    </div>
</div>
