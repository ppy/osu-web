{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if ($userCanModerate)
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
        title="{{ trans('forum.topics.lock.to_'.(int) !$topic->isLocked()) }}"
        data-remote="1"
        data-url="{{ route('forum.topics.lock', [
            $topic,
            'lock' => !$topic->isLocked(),
        ]) }}"
        data-method="post"
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
            title="{{ trans('forum.topics.lock.is_locked') }}"
        >
            <span class="btn-circle__content">
                <i class="fas fa-lock"></i>
            </span>
        </div>
    @endif
@endif
