{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
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
