{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! Form::open([
    'url' => route('forum.posts.update', $post),
    'method' => 'patch',
    'data-remote' => true,
    'class' => 'forum-post-edit-box js-forum-post-edit js-forum-post-input--form',
]) !!}
    @include('forum.topics._post_edit_form', [
        'content' => $post->bodyRaw,
        'inputId' => "post:{$post->getKey()}",
        'type' => 'edit',
    ])
{!! Form::close() !!}
