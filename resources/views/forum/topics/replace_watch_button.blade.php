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
Timeout.set(0, function() {
    var $new = $({!! json_encode(view('forum.topics._watch', [
        'topic' => $topic,
        'state' => $state,
    ])->render()) !!});
    var $current = $('.js-forum-topic-watch[data-topic-id={{ $topic->topic_id }}]');

    var $newButton = $new.find('.js-forum-topic-watch--button');
    $current.find('.js-forum-topic-watch--button').replaceWith($newButton);

    var $newMenu = $new.find('.js-forum-topic-watch--menu');
    $current.find('.js-forum-topic-watch--menu').html($newMenu.html());
});
