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
<div class="forum-post-info">
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

        @if ($user->title() !== null)
            <div class="forum-post-info__row forum-post-info__row--title">
                {{ $user->title() }}
            </div>
        @endif
    @else
        <span class="forum-post-info__row forum-post-info__row--username">
            {{ $user->username }}
        </span>
    @endif

    @if ($user->groupBadge() !== null)
        <div class="forum-post-info__row forum-post-info__row--group-badge">
            <div
                class="user-group-badge user-group-badge--t-forum"
                data-label="{{ $user->groupBadge()->short_name }}"
                title="{{ $user->groupBadge()->group_name }}"
                style="{!! css_group_colour($user->groupBadge()) !!}"
            ></div>
        </div>
    @endif

    @if ($user->country !== null)
        <div class="forum-post-info__row forum-post-info__row--flag">
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
