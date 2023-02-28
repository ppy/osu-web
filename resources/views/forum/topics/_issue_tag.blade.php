{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
    title="{{ osu_trans('forum.topics.issue_tag_'.$issueTag.'.to_'.(int) !$state) }}"
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
