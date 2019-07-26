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
        title="{{ trans('forum.topics.moderate_pin.to_'.$actionInt) }}"
    >
        <span class="btn-circle__content">
            <i class="fas fa-{{ $attrs['icon'] }}"></i>
        </span>
    </button>
@endforeach
