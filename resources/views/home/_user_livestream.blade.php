{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="user-home-livestream">
    <div
        id="home-livestream-{{ time() }}-{{ rand() }}"
        class="js-twitch-player user-home-livestream__player"
        data-channel="{{ $stream->data['user_name'] }}"
        data-muted="true"
    ></div>
</div>
