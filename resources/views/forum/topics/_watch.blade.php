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
@php
    $_menuId = 'topic-watch-'.$topic->topic_id.'#'.rand();
    $_menuOpen = $_menuOpen ?? false;
@endphp
<div
    class="js-forum-topic-watch"
    data-topic-id="{{ $topic->topic_id }}"
>
    <button
        type="button"
        class="
            btn-circle
            btn-circle--topic-nav
            {{ $state ? 'btn-circle--activated' : '' }}
            js-menu
        "
        data-menu-target="{{ $_menuId }}"
        data-url="{{ route('forum.topic-watches.update', [
            $topic,
        ]) }}"
        data-remote="1"
        data-method="{{ $state ? 'DELETE' : 'PUT' }}"
    >
        <span class="btn-circle__content">
            <i class="fa fa-eye"></i>
        </span>
    </button>
    <div
        class="js-menu simple-menu simple-menu--forum-topic-watch"
        data-menu-id="{{ $_menuId }}"
        data-visibility="{{ $_menuOpen ? '' : 'hidden' }}"
        style="position: absolute;"
    >
        <button
            type="button"
            class="simple-menu__item js-menu"
            data-url="{{ route('forum.topic-watches.update', $topic) }}"
            data-remote="1"
            data-method="PUT"
            {{ $state ? 'disabled' : '' }}
        >
            {{ trans('forum.topics.watch.to_1') }}
        </button>
        <button
            type="button"
            class="simple-menu__item js-menu"
            data-url="{{ route('forum.topic-watches.update', $topic) }}"
            data-remote="1"
            data-method="DELETE"
            {{ $state ? '' : 'disabled' }}
        >
            {{ trans('forum.topics.watch.to_0') }}
        </button>
    </div>
</div>
