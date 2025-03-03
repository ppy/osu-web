{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $popup = Session('popup');
@endphp
<div id="popup-container">
    <div class="alert alert-dismissable popup-clone col-md-6 col-md-offset-3 text-center" style="display: none">
        <span class="popup-text"></span>
    </div>

    @if ($popup !== null)
        <div class="alert alert-dismissable alert-info popup-active col-md-6 col-md-offset-3 text-center">
            <span class="popup-text">{{ $popup }}</span>
        </div>
    @endif
</div>
