{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@if (auth()->check() && auth()->user()->isAdmin() && $user->isRestricted())
    @include('objects._notification_banner', [
        'type' => 'warning',
        'title' => osu_trans('admin.users.restricted_banner.title'),
        'message' => osu_trans('admin.users.restricted_banner.message'),
    ])
@endif
