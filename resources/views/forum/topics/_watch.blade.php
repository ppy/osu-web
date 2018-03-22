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
    $menuId = 'topic-watch-'.$topic->topic_id.'#'.rand();
    $menuOpen = $menuOpen ?? false;
    $stateText = $state->stateText();

    $icons = [
        'not_watching' => 'eye',
        'watching' => 'eye',
        'watching_mail' => 'envelope',
    ];
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
            {{ $state->exists ? 'btn-circle--activated' : '' }}
            js-menu
        "
        data-menu-target="{{ $menuId }}"
    >
        <span class="btn-circle__content">
            <i class="fa fa-{{ $icons[$stateText] }}"></i>
        </span>
    </button>
    <div
        class="js-menu simple-menu simple-menu--forum-topic-watch"
        data-menu-id="{{ $menuId }}"
        data-visibility="{{ $menuOpen ? '' : 'hidden' }}"
        style="position: absolute;"
    >
        @foreach (['watching_mail', 'watching', 'not_watching'] as $newState)
            @php
                $isActive = $stateText === $newState;
            @endphp
            <button
                type="button"
                class="
                    simple-menu__item
                    {{ $isActive ? 'simple-menu__item--active' : '' }}
                    js-forum-topic-watch-ajax
                "
                data-url="{{ route('forum.topic-watches.update', [$topic, 'state' => $newState]) }}"
                data-forum-topic-watch-ajax-is-active="{{ $isActive ? '1' : '' }}"
                data-remote="1"
                data-method="PUT"
            >
                {{ trans("forum.topics.watch.to_{$newState}") }}
                <span class="simple-menu__item-loading-spinner">
                    <i class="fa fa-spinner fa-pulse"></i>
                </span>
            </button>
        @endforeach
    </div>
</div>
