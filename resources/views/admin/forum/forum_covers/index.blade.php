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
@extends('master')

@section('content')
    @include('admin/_header', ['title' => trans('admin.forum.forum-covers.index.title')])

    <div class="osu-page osu-page--admin">
        @foreach ($forums as $forum)
            <div class="forum-cover-admin-item" id="forum-{{ $forum->forum_id }}">
                <h2>
                    {!! link_to(
                        route('forum.forums.show', $forum->forum_id),
                        trans('admin.forum.forum-covers.index.forum-name', ['id' => $forum->forum_id, 'name' => $forum->forum_name])
                    ) !!}
                </h2>

                @foreach ([
                    'main' => ['cover' => $forum->cover, 'key' => 'main_cover'],
                    'default-topic' => ['cover' => $forum->cover->defaultTopicCover ?? null, 'key' => 'default_topic_cover']
                ] as $type => $cover)
                    <div class="forum-cover-admin-item__cover">
                        <h3>{{ trans("admin.forum.forum-covers.index.type-title.{$type}") }}</h3>

                        @if ($cover['cover'] !== null && $cover['cover']->fileUrl() !== null)
                            <div class="forum-cover-admin-item__cover-image"
                                style="background-image:url('{{ $cover['cover']->fileUrl() }}')"
                            ></div>

                            {!! Form::open([
                                'route' => ['admin.forum.forum-covers.update', $cover['cover']->id],
                                'method' => 'POST', 'files' => true
                            ]) !!}
                                <input name="_method" value="PUT" type="hidden" />
                                <input name="forum_cover[{{ $cover['key'] }}][cover_file]" type="file">

                                <label>
                                    <input name="forum_cover[{{ $cover['key'] }}][_delete]" value="1" type="checkbox" />
                                    {{ trans('admin.forum.forum-covers.index.delete') }}
                                </label>
                                <button class="btn-osu-big">{{ trans('admin.forum.forum-covers.index.submit.update') }}</button>
                            {!! Form::close() !!}
                        @else
                            {{ trans('admin.forum.forum-covers.index.no-cover') }}

                            {!! Form::open(['url' => route('admin.forum.forum-covers.store'), 'method' => 'POST', 'files' => true]) !!}
                                <input name="_method" value="POST" type="hidden" />
                                <input name="forum_cover[forum_id]" value="{{ $forum->forum_id }}" type="hidden" />
                                <input name="forum_cover[{{ $cover['key'] }}][cover_file]" type="file">
                                <button class="btn-osu-big">{{ trans('admin.forum.forum-covers.index.submit.save') }}</button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
