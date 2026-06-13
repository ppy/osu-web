{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="user-home-livestream">
    <a
        class="user-home-livestream__content"
        href="{{ $stream->url() }}"
        style="background-image: url('{{ $stream->preview(640, 360) }}');"
        target="_blank"
    >
        <div class="user-home-livestream__info">
            <h3 class="user-home-livestream__text user-home-livestream__text--name">
                {{ $stream->data['user_name'] }}
            </h3>

            <p class="user-home-livestream__text user-home-livestream__text--detail">
                {{ $stream->data['title'] }}
            </p>

            <p class="user-home-livestream__text user-home-livestream__text--detail">
                {{ $stream->data['viewer_count'] }} <i class="fas fa-eye"></i>
            </p>
        </div>
    </a>
</div>
