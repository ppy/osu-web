{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
Hi {{ $user->username }},

This is a confirmation email to inform you that your osu! email address has been changed to: "{{ $user->user_email }}".
For security reasons, this email has been sent both to your new and old email address.
Please ensure that you received this email at your new address to prevent losing access your osu! account in the future.

Please reply to this email IMMEDIATELY if you did not request this change.

@include('emails._signature')
