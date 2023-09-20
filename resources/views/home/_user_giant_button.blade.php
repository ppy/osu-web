{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

<a href="{{ $href }}" class="{{ class_with_modifiers('btn-home', $colour ?? null) }}">
    <span class="btn-home__text">{{ $label }}</span>
    <span class="btn-home__icon">
        <i class="fas fa-fw fa-{{$icon}}"></i>
    </span>
</a>
