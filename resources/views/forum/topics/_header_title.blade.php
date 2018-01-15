{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
<div class="forum-topic-title">
    <div class="js-forum-topic-title--main forum-topic-title__group">
        <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="forum-topic-title__title js-forum-topic-title--title">
            {{ $topic->topic_title }}
        </a>

        @if (priv_check('ForumTopicEdit', $topic)->can())
            <div class="forum-topic-title__button">
                <button
                    type="button"
                    class="js-forum-topic-title--edit-start btn-circle"
                    title="{{ trans('forum.topics.edit_title.start') }}"
                >
                    <span class="btn-circle__content">
                        <i class="fa fa-pencil"></i>
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
                        title="{{ trans('common.buttons.save') }}"
                    >
                        <span class="btn-circle__content">
                            <i class="fa fa-check"></i>
                        </span>
                    </button>
                </div>

                <div class="forum-topic-title__button">
                    <button
                        type="button"
                        class="js-forum-topic-title--cancel btn-circle"
                        title="{{ trans('common.buttons.cancel') }}"
                    >
                        <span class="btn-circle__content">
                            <i class="fa fa-close"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
