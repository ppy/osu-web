{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="notification-banner notification-banner--{{$type}}">
    <div class="notification-banner__icon"></div>
    <div class="notification-banner__icon-label">{{strtoupper($type)}}</div>
    <div class="notification-banner__text">{{ $title }}</div>
    <div class="notification-banner__text">{!! $message !!}</div>
    <div class="notification-banner__light-bar"></div>
</div>
