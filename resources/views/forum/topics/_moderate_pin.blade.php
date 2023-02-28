{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $types = [
        'sticky' => [
            'icon' => 'thumbtack',
        ],
        'announcement' => [
            'icon' => 'bullhorn',
        ],
    ];
    $normalTypeInt = App\Models\Forum\Topic::typeInt('normal');
@endphp
@foreach ($types as $type => $attrs)
    @php
        $typeInt = App\Models\Forum\Topic::typeInt($type);
        $activated = $topic->topic_type === $typeInt;
        $actionInt = $activated ? $normalTypeInt : $typeInt;
    @endphp
    <button
        type="button"
        class="
            btn-circle
            btn-circle--topic-nav
            btn-circle--yellow
            {{ $activated ? 'btn-circle--activated' : '' }}
            js-forum-topic-moderate_pin
            {{ $loop->first ? '' : 'js-forum-topic-moderate_pin--extra' }}
        "
        data-topic-id="{{ $topic->topic_id }}"
        data-url="{{ route('forum.topics.pin', [
            $topic,
            'pin' => $actionInt,
        ]) }}"
        data-remote="1"
        data-method="post"
        data-confirm="{{ osu_trans("forum.topics.moderate_pin.to_{$actionInt}_confirm") }}"
        title="{{ osu_trans("forum.topics.moderate_pin.to_{$actionInt}") }}"
    >
        <span class="btn-circle__content">
            <i class="fas fa-{{ $attrs['icon'] }}"></i>
        </span>
    </button>
@endforeach
