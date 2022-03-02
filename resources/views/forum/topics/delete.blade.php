{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('forum.topics.replace_delete_button', ['countDifference' => -1])

@section('action')
    if (window.forum.showDeleted()) {
        @if (priv_check('ForumModerate', $post->forum)->can())
            $el.addClass("js-forum-post--hidden");
        @endif
    } else {
        $el.css({
            minHeight: "0px",
            height: $el.css("height")
        }).slideUp(null, function () {
            $el.remove();
            window.forum.throttledBoot();
        });
    }
@endsection
