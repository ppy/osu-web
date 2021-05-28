{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="page-tabs page-tabs--follows">
    @foreach (['comment', 'forum_topic', 'mapping', 'modding'] as $menuSubtype)
        <a
            href="{{ route('follows.index', ['subtype' => $menuSubtype]) }}"
            class="page-tabs__tab {{ $subtype === $menuSubtype ? 'page-tabs__tab--active' : '' }}"
        >
            {{ trans("follows.{$menuSubtype}.title") }}
        </a>
    @endforeach
</div>
