{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
