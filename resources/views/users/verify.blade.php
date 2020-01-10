{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@extends('master', [
    // Verification doesn't inherit from App\Controller, thus these variables aren't set. Thus we set them here:
    'currentSection' => 'error',
    'currentAction' => '401',
])

@section('content')
    @include('layout._page_header_v4', ['params' => [
        'section' => trans('layout.header.notice._'),
    ]])
    <div class="osu-page osu-page--generic js-user-verification--on-load">
        {{ trans('users.verify.title') }}
    </div>
@endsection

@section('user-verification-box')
    @include('users._verify_box', compact('email'))
@endsection
