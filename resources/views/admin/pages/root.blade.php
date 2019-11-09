{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('admin/master')

@section('content')
    <div class="osu-layout__row osu-layout__row--page-admin">
        <h1>{{ trans('admin.pages.root.title') }}</h1>

        <h2 class="title">{{ trans('admin.pages.root.sections.general') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.logs.index') }}">
                    {{ trans('admin.logs.index.title') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contests.index') }}">Contests</a>
            </li>
        </ul>

        <h2 class="title">{{ trans('admin.pages.root.sections.store') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.store.orders.index') }}">
                    {{ trans('admin.store.orders.index.title') }}
                </a>
            </li>
        </ul>

        <h2 class="title">{{ trans('admin.pages.root.sections.forum') }}</h2>
        <ul>
            <li>
                <a href="{{ route('admin.forum.forum-covers.index') }}">
                    {{ trans('admin.forum.forum-covers.index.title') }}
                </a>
            </li>
        </ul>
    </div>
@endsection
