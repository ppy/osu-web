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
@php
    $stateText = $state->stateText();

    $icons = [
        'not_watching' => 'far fa-bookmark',
        'watching' => 'fas fa-bookmark',
        'watching_mail' => 'fas fa-envelope',
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
            js-forum-topic-watch--button
        "
        data-menu-target="topic-watch"
    >
        <span class="btn-circle__content">
            <i class="{{ $icons[$stateText] }}"></i>
        </span>
    </button>
    <div
        class="js-menu js-forum-topic-watch--menu simple-menu simple-menu--forum-topic-watch"
        data-menu-id="topic-watch"
        data-visibility="hidden"
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
                    {!! spinner() !!}
                </span>
            </button>
        @endforeach
    </div>
</div>
