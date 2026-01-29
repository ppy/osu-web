{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div
    id="home-livestream-{{ time() }}-{{ rand() }}"
    class="js-twitch-player user-home-livestream"
    data-channel="{{ $stream->data['user_name'] }}"
    data-autoplay="false"
></div>
