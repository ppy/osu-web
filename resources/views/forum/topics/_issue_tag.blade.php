{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<?php
    $state = $topic->hasIssueTag($issueTag);
    $slug = str_slug($issueTag);
?>

<label class="simple-menu__item">
    @include('objects._switch', ['locals' => [
        'additionalClass' => 'js-forum-topic-tag-editor-checkbox',
        'checked' => $state,
        'name' => $issueTag,
    ]])
    <span class="simple-menu__item-icon">{!! issue_icon($issueTag) !!}</span>
    <span>{{ $issueTag }}</span>
</label>
