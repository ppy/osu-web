{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
        .replaceWith({!! json_encode(render_to_string(
            'forum.topics._'.$type,
            compact('topic', 'state', 'userCanModerate')
        )) !!});

    osu.popup({!! json_encode(trans('forum.topics.'.$type.'.to_'.$stateText.'_done')) !!}, 'success');
});
