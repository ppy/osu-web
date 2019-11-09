{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    // Verification doesn't inherit from App\Controller, thus these variables aren't set. Thus we set them here:
    'currentSection' => 'error',
    'currentAction' => '401',
])

@section('content')
    <div class="osu-layout__row osu-layout__row--page">
        <h1>{{ trans('users.verify.title') }}</h1>
    </div>
@endsection

@section('script')
    @parent

    <script>
        window.showVerificationModal = true;
    </script>
@endsection

@section('user-verification-box')
    @include('users._verify_box', compact('email'))
@endsection
