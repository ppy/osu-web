{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<?php
    $state = $topic->hasIssueTag($issueTag);
    $slug = str_slug($issueTag);
?>

<label class="simple-menu__item">
    <label class="osu-switch-v2">
        <input type="checkbox" name="{{ $issueTag }}" class="osu-switch-v2__input js-forum-topic-tag-editor-checkbox" {{ $state ? 'checked' : '' }}>
        <span class="osu-switch-v2__content"></span>
    </label>
    <span class="simple-menu__item-icon">{!! issue_icon($issueTag) !!}</span>
    <span>{{ $issueTag }}</span>
</label>
