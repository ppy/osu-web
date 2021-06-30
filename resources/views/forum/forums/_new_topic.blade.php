{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $newTopicAuth = priv_check('ForumTopicStore', $forum);
    $newTopicEnabled = $newTopicAuth->can() || $newTopicAuth->requireLogin();
    $blockClass = $blockClass ?? 'btn-osu-big btn-osu-big--forum-button';

    if ($newTopicEnabled) {
        $element = 'a';
        $blockClass .= ' js-login-required--click';
        $attributes = [
            'href' => route('forum.topics.create', ['forum_id' => $forum]),
        ];
        if (!auth()->check()) {
            $icon = 'fas fa-sign-in-alt';
            $text = osu_trans('forum.topic.new_topic_login');
        }
    } else {
        $element = 'span';
        $attributes = [
            'disabled' => 1,
            'title' => $newTopicAuth->message(),
        ];
    }
@endphp
<{!! $element !!}
    class="{{ $blockClass }}"
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
    @if ($withIcon ?? true)
        <i class="{{ $icon ?? 'fas fa-plus' }}"></i>
    @endif
    {{ $text ?? osu_trans('forum.topic.new_topic') }}
</{!! $element !!}>
