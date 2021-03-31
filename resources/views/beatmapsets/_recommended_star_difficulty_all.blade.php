{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<script id="json-recommended-star-difficulty-all" type="application/json">
    {!! json_encode(optional(auth()->user())->recommendedStarDifficultyAll()) !!}
</script>
