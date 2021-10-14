{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master')

@section('content')
    @include('admin._header')
    <div class="osu-page osu-page--admin">
        <h2 class="title">{{ osu_trans('admin.pages.root.sections.general') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.logs.index') }}">
                    {{ osu_trans('admin.logs.index.title') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contests.index') }}">Contests</a>
            </li>
        </ul>

        <h2 class="title">{{ osu_trans('admin.pages.root.sections.forum') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.forum.forum-covers.index') }}">
                    {{ osu_trans('admin.forum.forum-covers.index.title') }}
                </a>
            </li>
        </ul>
    </div>
@endsection
