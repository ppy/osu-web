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
<?php
    $state = $topic->hasIssueTag($issueTag);
?>
<a
    class="
        js-forum-topic-issue_tag_{{ $issueTag }}
        btn-circle
        btn-circle--topic-nav
        {{ $state ? 'btn-circle--activated' : '' }}
    "
    href="{{ route('forum.topics.issue-tag', [
        $topic,
        'state' => !$state,
        'issue_tag' => $issueTag,
    ]) }}"
    data-remote="1"
    data-method="post"
    data-topic-id="{{ $topic->topic_id }}"
    title="{{ trans('forum.topics.issue_tag_'.$issueTag.'.action-'.(int) !$state) }}"
>
    <i class="fa {{ issue_icon($issueTag) }}"></i>
</a>
