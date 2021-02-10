{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div
    class="
        post-box-toolbar
        @if (isset($disabled) && $disabled === true)
            post-box-toolbar--disabled
        @endif
    "
>
    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--bold"
        title="{{ trans("bbcode.bold") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-bold"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--italic"
        title="{{ trans("bbcode.italic") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-italic"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--strikethrough"
        title="{{ trans("bbcode.strikethrough") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-strikethrough"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--heading"
        title="{{ trans("bbcode.heading") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-heading"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--link"
        title="{{ trans("bbcode.link") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-link"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--spoilerbox"
        title="{{ trans("bbcode.spoilerbox") }}"
        type="button"
    >
        <i class="fas fa-barcode"></i>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--list-numbered"
        title="{{ trans("bbcode.list_numbered") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-list-ol"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--list"
        title="{{ trans("bbcode.list") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-list"></i>
        </span>
    </button>

    <button
        class="btn-circle btn-circle--bbcode js-bbcode-btn--image"
        title="{{ trans("bbcode.image") }}"
        type="button"
    >
        <span class="btn-circle__content">
            <i class="fas fa-image"></i>
        </span>
    </button>

    <label class="bbcode-size-select" title="{{ trans("bbcode.size._") }}">
        <span class="bbcode-size-select__label">
            {{ trans("bbcode.size._") }}
        </span>
        <i class="fas fa-chevron-down"></i>

        <select class="bbcode-size-select__select js-bbcode-btn--size">
            <option value="50">{{ trans("bbcode.size.tiny") }}</option>
            <option value="85">{{ trans("bbcode.size.small") }}</option>
            <option value="100" selected>{{ trans("bbcode.size.normal") }}</option>
            <option value="150">{{ trans("bbcode.size.large") }}</option>
        </select>
    </label>
</div>
