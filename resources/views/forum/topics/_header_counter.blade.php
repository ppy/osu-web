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
<div class="counter-box counter-box--forum">
    <div class="counter-box__content">
        <div class="counter-box__title">
            {{ trans('forum.topics.show.total_posts') }}
        </div>

        <div class="counter-box__count">
            @if ($newTopic)
                1
            @else
                <span class="js-forum__total-count">
                    {{ $topic->postsCount() }}
                </span>
            @endif
        </div>
    </div>
    <div class="counter-box__line u-forum--bg">
    </div>
</div>
@if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isGMT()))
    <div class="counter-box counter-box--forum">
        <div class="counter-box__content">
            <div class="counter-box__title">
                {{ trans('forum.topics.show.deleted-posts') }}
            </div>

            <div class="counter-box__count js-forum__deleted-count">
                @if ($newTopic)
                    0
                @else
                    {{ $topic->deletedPostsCount() }}
                @endif
            </div>
        </div>
        <div class="counter-box__line u-forum--bg">
        </div>
    </div>
@endif
