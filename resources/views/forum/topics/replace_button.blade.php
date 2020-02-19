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
    if (!isset($stateText)) {
        if (method_exists($state, 'stateText')) {
            $stateText = $state->stateText();
        } elseif (is_bool($state)) {
            $stateText = $state ? '1' : '0';
        } else {
            $stateText = (string) $state;
        }
    }
@endphp
Timeout.set(0, function() {
    $('.js-forum-topic-{{ $type }}--extra[data-topic-id={{ $topic->topic_id }}]').remove();
    $('.js-forum-topic-{{ $type }}[data-topic-id={{ $topic->topic_id }}]')
        .replaceWith({!! json_encode(view(
            'forum.topics._'.$type,
            compact('topic', 'state', 'userCanModerate')
        )->render()) !!});

    osu.popup({!! json_encode(trans('forum.topics.'.$type.'.to_'.$stateText.'_done')) !!}, 'success');
});
