{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $country = $countryStats?->country;
@endphp

<div class="js-react u-contents" data-react="ranking-country-filter">
    <div class="ranking-filter ranking-filter--full">
        <div class="ranking-filter__title">
            {{ osu_trans('rankings.countries.title') }}
        </div>
        <div class="select-options select-options--ranking">
            <div class="select-options__select">
                <div class="select-options__option">{{ $country?->name ?? osu_trans('rankings.countries.all') }}</div>
            </div>
        </div>
    </div>
</div>

<script id="json-country-filter" type="application/json">
    {!! json_encode(json_options(
        $country,
        App\Models\Country::whereHasRuleset($params['mode'])->get(),
    )) !!}
</script>
