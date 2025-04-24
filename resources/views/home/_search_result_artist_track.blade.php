{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    use App\Transformers\ArtistTrackTransformer;

    $transformer = new ArtistTrackTransformer();
@endphp
<div class="u-contents js-audio--group">
    @foreach ($search->data() as $entry)
        <div
            class="js-react--artist-track u-contents"
            data-props="{{ json_encode([
                'modifiers' => 'search',
                'showAlbum' => true,
                'track' => json_item(
                    $entry,
                    $transformer,
                    $transformer::CARD_INCLUDES,
                ),
            ]) }}"
        ></div>
    @endforeach
</div>
