{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<a href="{{ route('packs.index', ['type' => $type]) }}"
   class="page-mode-link {{ $type === $current ? 'page-mode-link--is-active' : '' }}"
>
    {{ $title }}
    <span class="page-mode-link__stripe"></span>
</a>
