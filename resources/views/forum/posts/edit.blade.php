{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<form
    action="{{ route('forum.posts.update', $post) }}"
    class="forum-post-edit-box js-forum-post-edit js-forum-post-input--form"
    data-remote
    method="POST"
>
    @csrf
    <input name="_method" type="hidden" value="PATCH">
    @include('forum.topics._post_edit_form', [
        'content' => $post->bodyRaw,
        'inputId' => "post:{$post->getKey()}",
        'type' => 'edit',
    ])
</form>
