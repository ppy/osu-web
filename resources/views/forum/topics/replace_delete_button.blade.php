{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
Timeout.set(0, function () {
    for (var i = window.forum.posts.length - 1; i >= 0; i--) {
        var post = window.forum.posts[i];

        var position = forum.postPosition(post);

        post.setAttribute("data-post-position", position + {{ $countDifference }});

        if (forum.postId(post) === {{ $post->post_id }}) {
            break;
        }
    }

    var $el = $(".js-forum-post[data-post-id={{ $post->post_id }}]");

    @yield("action")

    @if (priv_check('ForumModerate', $post->forum)->can())
        var $toggle;

        @foreach (['circle', 'menu'] as $type)
            $toggle = $el.find(".js-post-delete-toggle--{{ $type }}");

            $toggle.replaceWith({!! json_encode(view('forum.posts._button_delete', [
                'post' => $post,
                'type' => $type,
            ])->render()) !!});
        @endforeach
    @endif

    window.forum.setTotalPosts(window.forum.totalPosts() + {{ $countDifference }});
    window.forum.setDeletedPosts(window.forum.deletedPosts() - {{ $countDifference }});
});
