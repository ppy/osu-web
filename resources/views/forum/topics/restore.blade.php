{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('forum.topics.replace_delete_button', ['countDifference' => 1])

@section('action')
    @if(priv_check('ForumModerate', $post->forum)->can())
        $el.removeClass("js-forum-post--hidden");
    @endif
@endsection
