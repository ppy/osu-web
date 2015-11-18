{{--
    Copyright 2015 ppy Pty. Ltd.

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
<div class="osu-layout__row">
    <div
        class="forum-category-header
            forum-category-header--topic
            {{ isset($topic) === true ?
                'forum-category-header--topic-'.$topic->forum->categorySlug()
                : 'forum-category-header--topic-create'
            }}
            js-forum-topic-cover--header"
        style="{{ isset($cover['data']['fileUrl']) === true ? "background-image: url('{$cover['data']['fileUrl']}');" : '' }}"
    >
        <div class="forum-category-header__loading js-forum-topic-cover--loading"></div>

        <div class="forum-category-header__titles">
            @include('forum.topics._header_breadcrumb', ['headerBreadcrumbExtraClasses' => 'forum-header-breadcrumb--large'])

            @if (isset($topic) === true)
                <h1 class="forum-category-header__title">
                    <a href="{{ route("forum.topics.show", $topic->topic_id) }}" class="link--white link--no-underline">
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            @else
                <input
                    class="forum-category-header__title js-forum-placeholder-hide"
                    required
                    tabindex="1"
                    name="title"
                    type="text"
                    value="{{ Request::old("title") }}"
                    placeholder="{{ trans("forum.topic.create.placeholder.title") }}"
                />
            @endif
        </div>

        @if (isset($topic) === false || $topic->canBeEditedBy(Auth::user()))
            <div class="forum-category-header__actions">
                <div class="forum-post-actions">
                    <div>
                        <a href="#" class="
                            js-forum-topic-cover--open-modal
                            forum-post-actions__action
                            forum-category-header__action
                        ">
                            <i class="fa fa-pencil"></i>
                        </a>

                        <div class="forum-category-header__cover-uploader js-forum-topic-cover--modal">
                            <label
                                class="btn-osu
                                    btn-osu--small
                                    btn-osu-default
                                    js-forum-topic-cover--upload-button
                                    fileupload
                                    forum-category-header__cover-uploader-label"
                                type="button"
                                data-file-url="{{ array_get($cover, 'data.fileUrl') }}"
                                data-url="{{ $cover['data']['url'] }}"
                                data-method="{{ $cover['data']['method'] }}"
                                data-topic-id="{{ isset($topic) === true ? $topic->topic_id : '' }}"
                            >
                                {{ trans('forum.topic_covers.create.button') }}
                                <input class="fileupload__input" type="file">
                            </label>
                            <p class="forum-category-header__cover-uploader-info">
                                {{ trans('forum.topic_covers.create.info', ['dimensions' => '2700x700']) }}
                            </p>

                            <div
                                class="forum-category-header__cover-uploader-overlay js-forum-topic-cover--overlay"
                                data-state="hidden">
                                    {{ trans('common.dropzone.target') }}
                            </div>
                        </div>
                    </div>

                    <a
                        href="#"
                        class="js-forum-topic-cover--remove
                            forum-post-actions__action
                            forum-category-header__action"
                        data-destroy-confirm="{{ trans('forum.topic_covers.destroy.confirm') }}"
                    >
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if (isset($topic) === true)
        <div class="forum-topic-header__sticky-marker js-sticky-header" data-sticky-header-target="forum-topic-headernav"></div>
    @endif
</div>
