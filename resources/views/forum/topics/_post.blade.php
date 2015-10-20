{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

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
        class="row-page forum-post flex-row post-viewer"
        data-post-id="{{ $post->post_id }}"
        data-post-position="{{ $options["postPosition"] }}">
    @if(is_int($post->post_id) && $post->post_id > 0)
        <div class="forum-post-anchor" id="forum-post-{{ $post->post_id }}"></div>
    @endif

    <div class="info-panel">
        @include("forum.topics._post_info", ["user" => $post->userNormalized(), "options" => ["large" => $options["large"]]])
    </div>

    <div class="post-panel">
        <div class="post-header {{ $options['large'] ? '' : 'post-body--small' }}">
            <div class="post-time"><a class="js-post-url link link--gray" href="{{ post_url($post->topic_id, $post->post_id) }}">
                {!! trans("forum.post.posted_at", ["when" => timeago($post->post_time)]) !!}
            </a></div>
        </div>

        <div class="forum-post-content post-body {{ $options['large'] ? '' : 'post-body--small' }}">
            {!! $post->bodyHTML !!}
        </div>

        <div class="post-footer">
            @if($post->post_edit_count > 0)
                <div class="post-edit-info">
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
                <div class="user-signature hidden-xs">
                    {!! bbcode($post->userNormalized()->user_sig, $post->userNormalized()->user_sig_bbcode_uid) !!}
                </div>
            @endif
        </div>
    </div>

    <div class="post-viewer__actions">
        @if ($options["editLink"] === true)
            <a href="{{ route("forum.posts.edit", $post) }}" class="post-viewer__action edit-post-link" data-remote="1">
                <i class="fa fa-edit"></i>
            </a>
        @endif
        @if ($options["deleteLink"] === true)
            <a href="{{ route("forum.posts.destroy", $post) }}" class="post-viewer__action delete-post-link" data-method="delete" data-confirm="{{ trans("forum.post.confirm_delete") }}" data-remote="1">
                <i class="fa fa-trash"></i>
            </a>
        @endif
        @if ($options["replyLink"] === true)
            <a href="{{ route("forum.posts.raw", ["id" => $post, "quote" => 1]) }}" class="post-viewer__action reply-post-link" data-remote="1">
                <i class="fa fa-reply"></i>
            </a>
        @endif
    </div>

    @if($options["overlay"] === true)
        <div class="post-overlay"></div>
    @endif
</div>
