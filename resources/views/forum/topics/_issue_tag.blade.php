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
<?php
    $state = $topic->hasIssueTag($issueTag);
?>
<button
    type="button"
    class="
        js-forum-topic-issue_tag_{{ $issueTag }}
        btn-circle
        btn-circle--topic-nav
        btn-circle--purple
        {{ $state ? 'btn-circle--activated' : '' }}
    "
    data-topic-id="{{ $topic->topic_id }}"
    title="{{ trans('forum.topics.issue_tag_'.$issueTag.'.to_'.(int) !$state) }}"
    data-url="{{ route('forum.topics.issue-tag', [
        $topic,
        'state' => !$state,
        'issue_tag' => $issueTag,
    ]) }}"
    data-remote="1"
    data-method="post"
>
    <span class="btn-circle__content">
        <i class="{{ issue_icon($issueTag) }}"></i>
    </span>
</button>
