{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
{!! Form::open([
    'url' => route('forum.posts.update', $post),
    'method' => 'patch',
    'data-remote' => true,
    'class' => 'js-forum-post-edit forum-post-edit-box',
]) !!}
    @include('forum.topics._post_edit_form', [
        'content' => $post->bodyRaw,
        'inputId' => "post:{$post->getKey()}",
        'type' => 'edit',
    ])
{!! Form::close() !!}
