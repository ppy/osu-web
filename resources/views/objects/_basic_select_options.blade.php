{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div
    class="js-react--basic-select-options"
    data-basic-select-options="{{ json_encode($selectOptions) }}"
>
    <div class="select-options">
        <div class="select-options__select">
            <span class="select-options__option">
                {{ $selectOptions['currentItem']['text'] }}
            </span>
        </div>
    </div>
</div>
