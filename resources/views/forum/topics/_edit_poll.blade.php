{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<form
    action="{{ route('forum.topics.edit-poll', $topic) }}"
    class="js-forum-poll-edit-save forum-poll"
    data-reload-on-success="1"
    data-remote
    method="POST"
>
    @csrf
    <div class="forum-poll__row forum-poll__row--title">
        <h2 class="forum-poll__title">
            {{ osu_trans('forum.topics.show.poll.edit') }}
        </h2>

        <span class="forum-poll__warning">
            {{ osu_trans('forum.topics.show.poll.edit_warning') }}
        </span>
    </div>

    @include('forum.topics._create_poll')

    <div class="forum-poll__row forum-poll__row--buttons">
        <div class="forum-poll__button">
            <button
                class="btn-osu-big btn-osu-big--forum-primary"
                type="submit"
                data-disable-with="{{ osu_trans('common.buttons.saving') }}"
            >
                {{ osu_trans('common.buttons.save') }}
            </button>
        </div>

        <div class="forum-poll__button">
            <button
                class="js-forum-poll--switch-edit btn-osu-big btn-osu-big--forum-secondary"
                type="button"
            >
                {{ osu_trans('common.buttons.cancel') }}
            </button>
        </div>
    </div>
</form>
