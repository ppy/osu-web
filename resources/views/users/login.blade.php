{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
<div class="osu-layout__row osu-layout__row--page">
    <h1>Please login to continue</h1>
</div>
@endsection

@section("script")
<script>
    window.showLoginModal = true
</script>
@endsection
