{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($userCanModerate)
    @php
        $actionInt = $topic->isLocked() ? 0 : 1;
    @endphp
    <button
        type="button"
        class="
            js-forum-topic-lock
            btn-circle
            btn-circle--topic-nav
            btn-circle--yellow
            {{ $topic->isLocked() ? 'btn-circle--activated' : '' }}
        "
        data-topic-id="{{ $topic->topic_id }}"
        title="{{ osu_trans("forum.topics.lock.to_{$actionInt}") }}"
        data-remote="1"
        data-url="{{ route('forum.topics.lock', [
            $topic,
            'lock' => $actionInt,
        ]) }}"
        data-method="post"
        data-confirm="{{ osu_trans("forum.topics.lock.to_{$actionInt}_confirm") }}"
    >
        <span class="btn-circle__content">
            <i class="fas fa-lock"></i>
        </span>
    </button>
@else
    @if ($topic->isLocked())
        <div
            class="btn-circle btn-circle--topic-nav btn-circle--blank"
            data-tooltip-float="fixed"
            title="{{ osu_trans('forum.topics.lock.is_locked') }}"
        >
            <span class="btn-circle__content">
                <i class="fas fa-lock"></i>
            </span>
        </div>
    @endif
@endif
