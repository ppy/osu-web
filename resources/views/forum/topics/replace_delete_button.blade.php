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

    @if (priv_check('ForumModerate', $post->forum)->can())
        @yield("moderatorAction")

        var $toggle = $el.find(".js-post-delete-toggle");

        $toggle.html({!! json_encode(render_to_string('forum.topics._post_hide_action', [
            'post' => $post,
        ])) !!});
        osu.pageChange();
    @else
        $el.css({
            minHeight: "0px",
            height: $el.css("height")
        }).slideUp(null, function () {
            $el.remove();
            osu.pageChange();
        });
    @endif

    window.forum.setTotalPosts(window.forum.totalPosts() + {{ $countDifference }});
    window.forum.setDeletedPosts(window.forum.deletedPosts() - {{ $countDifference }});
});
