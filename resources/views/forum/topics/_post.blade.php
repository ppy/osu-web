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
<?php
    $options['postPosition'] = $options['postPosition'] ?? 1;
    $options['signature'] = $options['signature'] ?? true;

    $options['buttons']['delete'] = $options['buttons']['delete'] ?? false;
    $options['buttons']['edit'] = $options['buttons']['edit'] ?? false;
    $options['buttons']['quote'] = $options['buttons']['quote'] ?? false;

    $buttons = [];

    foreach (['edit', 'delete', 'quote'] as $buttonType) {
        if ($options['buttons'][$buttonType]) {
            $buttons[] = $buttonType;
        }
    }

    $user = $post->userNormalized();
?>
<div
    class="js-forum-post {{ $post->trashed() ? 'js-forum-post--hidden' : '' }} forum-post"
    data-post-id="{{ $post->getKey() }}"
    data-post-position="{{ $options["postPosition"] }}"
>
    @include('forum.topics._post_info', compact('user'))

    <div class="forum-post__body js-forum-post-edit--container">
        <div class="forum-post__content forum-post__content--header">
            <div class="forum-post__header-content">
                @if (isset($topic) && $topic->topic_poster === $post->poster_id)
                    <div class="forum-post__header-content-item">
                        <span class="forum-user-badge">
                            {{ trans('forum.post.info.topic_starter') }}
                        </span>
                    </div>
                @endif

                <div class="forum-post__header-content-item">
                    {!! link_to_user($user, null, '', ['forum-post__user']) !!}

                    <a class="link link--default js-post-url" rel="nofollow" href="{{ $post->exists ? route('forum.posts.show', $post->post_id) : '#' }}">
                        {!! timeago($post->post_time) !!}
                    </a>
                </div>
            </div>

            @if (count($buttons) > 0)
                <div class="forum-post__menu">
                    @php
                        $menuId = implode(':', ['forum-post', $post->getKey(), rand()]);
                    @endphp
                    <button class="forum-post__menu-button js-click-menu" data-click-menu-target="{{ $menuId }}">
                        <span class="fas fa-ellipsis-v"></span>
                    </button>

                    <div
                        class="simple-menu simple-menu--forum-list js-click-menu"
                        data-visibility="hidden"
                        data-click-menu-id="{{ $menuId }}"
                    >
                        @foreach ($buttons as $button)
                            @include("forum.posts._button_{$button}", [
                                'class' => 'simple-menu__item',
                                'post' => $post,
                                'type' => 'menu',
                            ])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="forum-post__content forum-post__content--main">
            <div class="forum-post-content {{ $options['contentExtraClasses'] ?? '' }}">
                {!! $post->bodyHTML() !!}
            </div>
        </div>

        @if($post->post_edit_count > 0)
            <div class="forum-post__content forum-post__content--footer">
                {!!
                    trans_choice('forum.post.edited', $post->post_edit_count, [
                        'user' => link_to_user($post->lastEditorNormalized(), null, '', ['link link--default']),
                        'when' => timeago($post->post_edit_time),
                    ])
                !!}
            </div>
        @endif

        @if($options["signature"] !== false && present($post->userNormalized()->user_sig))
            <div class="forum-post__content forum-post__content--signature hidden-xs">
                {!! bbcode($post->userNormalized()->user_sig, $post->userNormalized()->user_sig_bbcode_uid) !!}
            </div>
        @endif

        @if (count($buttons) > 0)
            <div class="forum-post__actions">
                <div class="forum-post-actions">
                    @foreach ($buttons as $button)
                        <div class="forum-post-actions__action">
                            @include("forum.posts._button_{$button}", ['post' => $post, 'type' => 'circle'])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
