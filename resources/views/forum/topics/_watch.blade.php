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
<button
    type="button"
    class="
        btn-circle
        btn-circle--topic-nav
        {{ $state ? 'btn-circle--activated' : '' }}
        js-forum-topic-watch
    "
    data-url="{{ route('forum.topics.watch', [
        $topic,
        'watch' => !$state,
    ]) }}"
    data-remote="1"
    data-method="post"
    data-topic-id="{{ $topic->topic_id }}"
    title="{{ trans('forum.topics.watch.watch-'.(int) !$state) }}"
>
    <span class="btn-circle__container">
        <i class="fa fa-eye"></i>
    </span>
</button>
