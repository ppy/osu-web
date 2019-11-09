{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
    @else
        <span class="forum-post-info__row forum-post-info__row--username">
            {{ $user->username }}
        </span>
    @endif

    @if ($user->groupBadge() !== null)
        <div class="forum-post-info__row forum-post-info__row--group-badge">
            <div class="{{ class_with_modifiers('user-group-badge', [
                't-forum',
                $user->groupBadge(),
            ]) }}"></div>
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
