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
<div class="livestream-item">
    <a class="livestream-item__content" href="{{$stream->channel->url}}">
        <div
            class="livestream-item__image"
            style="background-image: url('{{$stream->preview->medium}}');"
        ></div>

        <p class="livestream-item__text livestream-item__text--name">
            {{$stream->channel->name}}
        </p>

        <p class="livestream-item__text livestream-item__text--detail">
            {{$stream->viewers}} <i class="fa fa-eye"></i>
        </p>
    </a>

    @if (priv_check('LivestreamPromote')->can())
        <div class="livestream-item__actions">
            <div class="forum-post-actions">
                <a
                    data-remote="1"
                    data-method="POST"
                    class="forum-post-actions__action"
                    href="{{route('livestreams.promote', ['id' => $stream->_id])}}"
                >
                    <i class="fa fa-thumbs-up"></i>
                </a>
            </div>
        </div>
    @endif
</div>
