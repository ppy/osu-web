{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $user = auth()->user();

    $userJson = $user === null
        ? '{}'
        : json_encode(json_item($user, new App\Transformers\CurrentUserTransformer()));
@endphp
<script id="json-current-user" type="application/json">
    {!! $userJson !!}
</script>
