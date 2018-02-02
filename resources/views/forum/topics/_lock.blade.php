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
@if (priv_check('ForumTopicModerate', $topic)->can())
    <button
        type="button"
        class="
            js-forum-topic-lock
            btn-circle
            btn-circle--topic-nav
            btn-circle--yellow
            {{ $topic->isLocked() ? 'btn-circle--activated' : '' }}
        "
        data-topic-id="{{ $topic->topic_id }}"
        title="{{ trans('forum.topics.lock.lock-'.(int) !$topic->isLocked()) }}"
        data-remote="1"
        data-url="{{ route('forum.topics.lock', [
            $topic,
            'lock' => !$topic->isLocked(),
        ]) }}"
        data-method="post"
    >
        <span class="btn-circle__content">
            <i class="fa fa-lock"></i>
        </span>
    </button>
@else
    @if ($topic->isLocked())
        <div
            class="btn-circle btn-circle--topic-nav btn-circle--blank"
            data-tooltip-float="fixed"
            title="{{ trans('forum.topics.lock.is_locked') }}"
        >
            <span class="btn-circle__content">
                <i class="fa fa-lock"></i>
            </span>
        </div>
    @endif
@endif
