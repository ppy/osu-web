{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $template = ($legacyNav ?? true) ? 'objects._notification_banner_v1' : 'objects._notification_banner_v2';
@endphp
@push('notification_banners')
    @include($template, compact('type', 'title', 'message'))
@endpush
