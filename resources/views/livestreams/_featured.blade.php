{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<?php
    $playerId = 'livestream-'.time().'-'.rand();
?>
<div class="livestream-featured">
    <div
        id="{{ $playerId }}"
        class="js-twitch-player livestream-featured__content hidden"
        data-channel="{{ $featuredStream->user['login'] }}"
    ></div>

    <a
        href="{{ $featuredStream->url() }}"
        class="js-twitch-player--no-cookie livestream-featured__content livestream-featured__content--no-cookie"
        style="background-image: url('{{ $featuredStream->preview(1280, 720) }}');"
        data-visibility="visible"
        data-player-id="{{ $playerId }}"
    >
        <div class="livestream-featured__info">
            <h3 class="livestream-featured__text livestream-featured__text--name">
                {{ $featuredStream->user['display_name'] }}
            </h3>

            <p class="livestream-featured__text livestream-featured__text--detail">
                {{ $featuredStream->data['title'] }}
            </p>

            <p class="livestream-featured__text livestream-featured__text--detail">
                {{ $featuredStream->data['viewer_count'] }} <i class="fas fa-eye"></i>
            </p>
        </div>
    </a>

    @if (priv_check('LivestreamPromote')->can())
        <div class="livestream-featured__actions">
            <button
                type="button"
                class="btn-circle"
                data-remote="1"
                data-method="POST"
                data-url="{{ route('livestreams.promote') }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-thumbs-down"></i>
                </span>
            </button>
        </div>
    @endif
</div>
