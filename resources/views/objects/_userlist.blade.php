{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}

@foreach ($userlist as $status => $users)
    <div class="page-title page-title--lighter">{{trans("users.status.$status")}} ({{count($users)}})</div>
    <div class="usercard-list">
        <div class="usercard-list__cards">
            @foreach ($users as $user)
                @include('objects._usercard', ['user' => $user])
            @endforeach
        </div>
    </div>
@endforeach
