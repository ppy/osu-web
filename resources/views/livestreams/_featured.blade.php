{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div class="livestream-featured">
    <div
        id="{{ 'livestream-'.time().'-'.rand() }}"
        class="js-twitch-player u-contents"
        data-channel="{{ $featuredStream->data['user_name'] }}"
    ></div>

    @if (priv_check('LivestreamPromote')->can())
        <div class="livestream-featured__actions">
            <button
                type="button"
                class="btn-circle btn-circle--activated"
                data-confirm="{{ osu_trans('livestreams.promote.unpin') }}"
                data-remote="1"
                data-method="POST"
                data-url="{{ route('livestreams.promote') }}"
            >
                <span class="btn-circle__content">
                    <i class="fas fa-thumbtack"></i>
                </span>
            </button>
        </div>
    @endif
</div>
