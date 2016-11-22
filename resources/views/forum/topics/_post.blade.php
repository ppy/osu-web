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
<?php
    if (!isset($options['deleteLink'])) { $options['deleteLink'] = false; }
    if (!isset($options['editLink'])) { $options['editLink'] = false; }
    if (!isset($options['overlay'])) { $options['overlay'] = false; }
    if (!isset($options['signature'])) { $options['signature'] = true; }
    if (!isset($options['replyLink'])) { $options['replyLink'] = false; }
    if (!isset($options['postPosition'])) { $options['postPosition'] = 1; }
    if (!isset($options['large'])) { $options['large'] = $options['postPosition'] === 1; }
?>
<div
    class="js-forum-post osu-layout__row {{ $options['large'] ? '' : 'osu-layout__row--sm2-desktop' }}"
    data-post-id="{{ $post->post_id }}"
    data-post-position="{{ $options["postPosition"] }}"
>
    <div class="forum-post {{ $post->deleted_at ? 'forum-post--hidden' : '' }}">
        @if ($post->userNormalized()->is_special)
            <div
                class="forum-post__stripe"
                style="{{ user_colour_style($post->userNormalized()->user_colour, "background-color") }}"
            ></div>
        @endif

        @include("forum.topics._post_info", ["user" => $post->userNormalized()])

        <div class="forum-post__body">
            <div class="forum-post__content forum-post__content--header">
                <a class="js-post-url link link--gray" href="{{ route('forum.posts.show', $post->post_id) }}">
                    {!! trans("forum.post.posted_at", ["when" => timeago($post->post_time)]) !!}
                </a>
            </div>

            <div class="forum-post__content forum-post__content--main">
                <div class="forum-post-content">
                    {!! $post->bodyHTML !!}
                </div>
            </div>

            @if($post->post_edit_count > 0)
                <div class="forum-post__content forum-post__content--footer">
                    {!!
                        trans("forum.post.edited", [
                            "count" => $post->post_edit_count,
                            "user" => $post->lastEditorNormalized()->username,
                            "when" => timeago($post->post_edit_time),
                        ])
                    !!}
                </div>
            @endif

            @if($options["signature"] !== false && $post->userNormalized()->user_sig)
                <div class="forum-post__content forum-post__content--signature hidden-xs">
                    {!! bbcode($post->userNormalized()->user_sig, $post->userNormalized()->user_sig_bbcode_uid) !!}
                </div>
            @endif
        </div>

        <div class="forum-post__actions">
            <div class="forum-post-actions">
                @if ($options['editLink'] === true)
                    <div class="forum-post-actions__action">
                        <a
                            title="{{ trans('forum.post.actions.edit') }}"
                            data-tooltip-position="left center"
                            href="{{ route('forum.posts.edit', $post) }}"
                            class="btn-circle edit-post-link"
                            data-remote="1"
                        >
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                @endif

                @if ($options["deleteLink"] === true)
                    @include('forum.topics._post_hide_action')
                @endif

                @if ($options['replyLink'] === true)
                    <div class="forum-post-actions__action">
                        <a
                            title="{{ trans('forum.topics.actions.reply_with_quote') }}"
                            data-tooltip-position="left center"
                            href="{{ route('forum.posts.raw', ['id' => $post, 'quote' => 1]) }}"
                            class="btn-circle js-forum-topic-reply--quote"
                            data-remote="1"
                        >
                            <i class="fa fa-reply"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if($options["overlay"] === true)
            <div class="forum-post__overlay"></div>
        @endif
    </div>
</div>
