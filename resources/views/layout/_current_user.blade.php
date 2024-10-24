{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentUser ??= Auth::user();

    $currentUserJson = $currentUser === null
        ? '{}'
        : json_encode(json_item($currentUser, new App\Transformers\CurrentUserTransformer()));
@endphp
<script id="json-current-user" type="application/json">
    {!! $currentUserJson !!}
</script>
<script>
    {{--
        Set current user on first page load. Further updates are done in
        reactTurbolinks before the new page is rendered.
        This needs to be fired before everything else (turbo:load etc).
    --}}
    if (!osuCore.firstCurrentUserSet) {
        osuCore.firstCurrentUserSet = true;
        osuCore.updateCurrentUser();
    }
</script>
