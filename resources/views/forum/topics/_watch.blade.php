{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
    class="js-forum-topic-watch u-relative"
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
                {{ osu_trans("forum.topics.watch.to_{$newState}") }}
                <span class="simple-menu__item-loading-spinner">
                    {!! spinner() !!}
                </span>
            </button>
        @endforeach
    </div>
</div>
