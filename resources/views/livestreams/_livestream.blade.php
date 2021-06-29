{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="livestream-item">
    <a class="livestream-item__content" href="{{ $stream->url() }}">
        <div
            class="livestream-item__image"
            style="background-image: url('{{ $stream->preview(640, 360) }}');"
        ></div>

        <p class="livestream-item__text livestream-item__text--name">
            {{ $stream->data['user_name'] }}
        </p>

        <p class="livestream-item__text livestream-item__text--detail">
            {{ $stream->data['viewer_count'] }} <i class="fas fa-eye"></i>
        </p>
    </a>

    @if (priv_check('LivestreamPromote')->can())
        <div class="livestream-item__actions">
            <button
                type="button"
                class="btn-circle"
                data-confirm="{{ osu_trans('livestreams.promote.pin') }}"
                data-remote="1"
                data-method="POST"
                data-url="{{ route('livestreams.promote', ['id' => $stream->data['id']]) }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-thumbtack"></i>
                </span>
            </button>
        </div>
    @endif
</div>
