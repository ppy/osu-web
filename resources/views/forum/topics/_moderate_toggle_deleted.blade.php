{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<button
    type="button"
    class="
        btn-circle
        btn-circle--topic-nav
        btn-circle--yellow
        {{ $showDeleted ? '' : 'btn-circle--activated' }}
        js-forum-topic-moderate--toggle-deleted
    "
    title="{{ trans('forum.topics.moderate_toggle_deleted.' . ($showDeleted ? 'hide' : 'show')) }}"
    data-show-deleted="{{ $showDeleted ? 1 : 0 }}"
>
    <span class="btn-circle__content">
        <i class="fa fa-trash"></i>
    </span>
</button>
