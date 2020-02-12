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
        osu.pageChange();
    @endif

    window.forum.setTotalPosts(window.forum.totalPosts() + {{ $countDifference }});
    window.forum.setDeletedPosts(window.forum.deletedPosts() - {{ $countDifference }});
});
