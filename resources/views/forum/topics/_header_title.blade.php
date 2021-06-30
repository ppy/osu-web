{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="forum-topic-title">
    <div class="js-forum-topic-title--main forum-topic-title__group">
        <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="forum-topic-title__title js-forum-topic-title--title">
            {{ $topic->topic_title }}
        </a>

        @if (priv_check('ForumTopicEdit', $topic)->can())
            <div class="forum-topic-title__button forum-topic-title__button--edit">
                <button
                    type="button"
                    class="js-forum-topic-title--edit-start btn-circle"
                    title="{{ osu_trans('forum.topics.edit_title.start') }}"
                >
                    <span class="btn-circle__content">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                </button>
            </div>
        @endif
    </div>

    <div class="js-forum-topic-title--editor forum-topic-title__group hidden">
        <input
            class="forum-topic-title__input js-forum-topic-title--input"
            value="{{ $topic->topic_title }}"
            data-url="{{ route('forum.topics.update', $topic->getKey()) }}"
            maxlength="{{ App\Models\Forum\Topic::MAX_FIELD_LENGTHS['topic_title'] }}"
            name="forum_topic[topic_title]"
        >

        <div class="forum-topic-title__buttons-container">
            <div class="forum-topic-title__buttons-padding js-forum-topic-title--padding"></div>

            <div class="forum-topic-title__buttons js-forum-topic-title--buttons">
                <div class="forum-topic-title__button">
                    <button
                        type="button"
                        class="js-forum-topic-title--save btn-circle"
                        title="{{ osu_trans('common.buttons.save') }}"
                    >
                        <span class="btn-circle__content">
                            <i class="fas fa-check"></i>
                        </span>
                    </button>
                </div>

                <div class="forum-topic-title__button">
                    <button
                        type="button"
                        class="js-forum-topic-title--cancel btn-circle"
                        title="{{ osu_trans('common.buttons.cancel') }}"
                    >
                        <span class="btn-circle__content">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
