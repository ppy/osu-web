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
<div class="js-forum-topic-reply--container js-sync-height--target forum-topic-reply" data-sync-height-id="forum-topic-reply">
    {!! Form::open([
        'url' => route('forum.topics.reply', $topic->getKey()),
        'class' => 'osu-page osu-page--forum-topic-reply js-forum-topic-reply js-sync-height--reference js-fixed-element',
        'data-remote' => true,
        'data-sync-height-target' => 'forum-topic-reply',
        'data-force-reload' => Auth::check() ? '0' : '1',
    ]) !!}
        @if (priv_check('ForumTopicReply', $topic)->can())
            @if (!$topic->isActive())
                <div class="warning-box">
                    <div class="warning-box__icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>

                    @if (priv_check('ForumTopicStore', $topic->forum)->can())
                        <div class="warning-box__content">
                            {!! trans('forum.topic.create.necropost.new_topic._', [
                                'create' => link_to_route(
                                    'forum.topics.create',
                                    trans('forum.topic.create.necropost.new_topic.create'),
                                    ['forum_id' => $topic->forum],
                                    ['class' => 'link link--default']
                                ),
                            ]) !!}
                        </div>
                    @else
                        {{ trans('forum.topic.create.necropost.default') }}
                    @endif
                </div>
            @endif

            <div class="forum-post-edit js-forum-topic-reply--block js-forum-reply-preview" data-state="write">
                <div class="forum-post-edit__header">
                    <h2 class="forum-post-edit__title">
                        {{ trans('forum.post.create.title.reply') }}
                    </h2>
                </div>

                <div class="js-forum-reply-write forum-post-edit__content">
                    <textarea
                        class="
                            forum-post-edit__body
                            js-ujs-submit-disable
                            js-quick-submit
                            js-forum-topic-reply--input
                        "
                        required
                        name="body"
                        placeholder="{{ trans('forum.topic.create.placeholder.body') }}"
                    ></textarea>

                    <div class="js-forum-reply-preview forum-post-edit__preview">
                        <div class="forum-post-content forum-post-content--reply-preview js-forum-reply-preview--content">
                        </div>
                    </div>

                    <div class="forum-post-edit__buttons-bar">
                        <div class="forum-post-edit__buttons forum-post-edit__buttons--toolbar">
                            @include("forum._post_toolbar")
                        </div>

                        <div class="forum-post-edit__buttons forum-post-edit__buttons--actions">
                            <div class="forum-post-edit__button forum-post-edit__button--deactivate">
                                <button
                                    type="button"
                                    class="js-forum-topic-reply--deactivate btn-osu-big btn-osu-big--forum-primary"
                                >
                                    {{ trans('forum.topic.create.close') }}
                                </button>
                            </div>

                            <div class="forum-post-edit__button forum-post-edit__button--write">
                                <button
                                    type="button"
                                    class="js-forum-reply-preview--hide btn-osu-big btn-osu-big--forum-post-edit-preview"
                                >
                                    {{ trans('forum.topic.create.preview_hide') }}
                                </button>
                            </div>

                            <div class="forum-post-edit__button forum-post-edit__button--preview">
                                <button
                                    type="button"
                                    class="js-forum-reply-preview--show btn-osu-big btn-osu-big--forum-post-edit-preview"
                                >
                                    {{ trans('forum.topic.create.preview') }}
                                </button>
                            </div>

                            <div class="forum-post-edit__button">
                                <button
                                    class="btn-osu-big btn-osu-big--forum-primary"
                                    type="submit"
                                    data-disable-with="{{ trans('common.buttons.saving') }}"
                                >
                                    {{ trans('forum.topic.post_reply') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="warning-box">
                <div class="warning-box__icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

                <div class="warning-box__content">
                    {{ priv_check('ForumTopicReply', $topic)->message() }}
                </div>
            </div>
        @endif
    {!! Form::close() !!}
</div>
