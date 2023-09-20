{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<script id="json-filters" type="application/json">
    {!! json_encode(App\Libraries\Search\BeatmapsetSearchRequestParams::getAvailableFilters()) !!}
</script>
