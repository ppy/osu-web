{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
    $el = $(".js-forum-post[data-post-id={{ $post->post_id }}]")

    $toggle = $el.find(".delete-post-link");
    action = $toggle.attr('data-action');

    if (currentUser.isAdmin || currentUser.isGMT) {
        $post = $el.find(".forum-post");

        switch (action) {
            case 'delete':
                $post.addClass("js-forum-post-hidden");
                break;
            case 'restore':
                $post.removeClass("js-forum-post-hidden");
                break;
        }

        $toggle.replaceWith({!! json_encode(render_to_string('forum.topics._post_hide_action', [
            'post' => $post,
        ])) !!});
    } else {
        $el.css({
            minHeight: "0px",
            height: $el.css("height")
        }).slideUp(null, function () {
            return $el.remove();
        });
    }

    countDifference = action === "delete" ? -1 : 1;

    window.forum.setTotalPosts(window.forum.totalPosts() + countDifference);

    for (i = window.forum.posts.length - 1; i >= 0; i--) {
        post = window.forum.posts[i];

        originalPosition = forum.postPosition(post);

        if (originalPosition < {{ $deletedPostPosition }}) {
            break;
        }

        post.setAttribute("data-post-position", originalPosition + countDifference);
    }
});
