{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@section('fixed-bar-rows-bottom')
    @parent

    <a id="forum-search" class="forum-search-logo js-forum-search-button" href="#" data-toggle="modal" data-target="#forum-search-modal">
        <i class="fa fa-search"></i>
    </a>
@endsection

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
                                <i class="fa fa-search"></i>
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
                        <form method="get">
                        <div class="text-addon-append">
                            <span>#</span>
                            <input type="text" class="form-control modal-af" name="n" placeholder="{{ trans("forum.search.post_number_input") }}" />
                            <button type="submit">
                                <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                        </form>
                        {{ trans("forum.search.total_posts", ["posts_count" => $topic->postsCount()]) }}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <span class="forum-search-logo">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div></div>
    </div>
@endsection
