{{--
    Copyright 2016 ppy Pty. Ltd.

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
        data-channel="{{ $featuredStream->channel->name }}"
    ></div>

    <a
        href="{{ $featuredStream->channel->url }}"
        class="js-twitch-player--no-cookie livestream-featured__content livestream-featured__content--no-cookie"
        style="background-image: url('{{ $featuredStream->preview->large }}');"
        data-visibility="visible"
        data-player-id="{{ $playerId }}"
    >
        <div class="livestream-featured__info">
            <h3 class="livestream-featured__text livestream-featured__text--name">
                {{ $featuredStream->channel->name }}
            </h3>

            <p class="livestream-featured__text livestream-featured__text--detail">
                {{ $featuredStream->channel->status }}
            </p>

            <p class="livestream-featured__text livestream-featured__text--detail">
                {{ $featuredStream->viewers }} <i class="fa fa-eye"></i>
            </p>
        </div>
    </a>

    @if (priv_check('LivestreamPromote')->can())
        <div class="livestream-featured__actions">
            <a
                data-remote="1"
                data-method="POST"
                class="btn-circle"
                href="{{ route('livestreams.promote') }}"
            >
                <i class="fa fa-thumbs-down"></i>
            </a>
        </div>
    @endif
</div>

@section('script')
    @parent

    <script src="https://player.twitch.tv/js/embed/v1.js"></script>
@endsection
