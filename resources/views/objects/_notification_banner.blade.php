{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@push('notification_banners')
    <div class="notification-banner-v2 notification-banner-v2--{{ $type }}">
        <div class="notification-banner-v2__col notification-banner-v2__col--icon"></div>

        <div class="notification-banner-v2__col notification-banner-v2__col--label">
            <div class="notification-banner-v2__type">{{ $type }}</div>
            <div class="notification-banner-v2__text">{{ $title }}</div>
        </div>

        <div class="notification-banner-v2__col">
            <div class="notification-banner-v2__text">
                {!! $message !!}
            </div>
        </div>
    </div>
@endpush
