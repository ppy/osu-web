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
<a
    id="forum-search"
    class="forum-search-logo js-forum-search-button u-forum--bg-link"
    href="#"
    data-toggle="modal"
    data-target="#forum-search-modal"
>
    <i class="fas fa-search"></i>
</a>

@section("script")
    @parent
    <div id="forum-search-modal" class="modal" tabindex="-1">
        <div class="modal-dialog js-forum-search-box"><div class="modal-content">
            <div class="modal-body">
                @if (false)
                <div>
                    <h2>{{ trans("forum.search.title") }}</h2>
                    <form action="#">
                        <div class="text-addon-append">
                            <input type="text" class="form-control" />
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <div class="forumselect">
                            <label class="flex-checkbox">
                                <input type="checkbox" />
                                {{ trans("forum.search.forums_select") }}
                            </label>
                        </div>

                        <label class="flex-checkbox">
                            <input type="checkbox" />
                            {{ trans("forum.search.current_topic") }}
                        </label>
                    </form>
                </div>
                @endif

                @if(isset($topic))
                    <div>
                        <h2>{{ trans("forum.search.go_to_post") }}</h2>
                        <form method="get" class="js-forum-posts-jump-to text-addon-append">
                            <span>#</span>
                            <input type="text" class="form-control modal-af" name="n" placeholder="{{ trans("forum.search.post_number_input") }}" />
                            <button type="submit">
                                <i class="fas fa-angle-right"></i>
                            </button>
                        </form>
                        {{
                            trans(
                                "forum.search.total_posts",
                                ["posts_count" => $topic->postsCount()]
                            )
                        }}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <span class="forum-search-logo">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div></div>
    </div>
@endsection
