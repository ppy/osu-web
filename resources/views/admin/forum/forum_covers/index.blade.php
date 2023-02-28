{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('admin.forum.forum-covers.index.title')])

@section('content')
    @include('admin/_header')

    <div class="osu-page osu-page--admin">
        @foreach ($forums as $forum)
            <div class="forum-cover-admin-item" id="forum-{{ $forum->forum_id }}">
                <h2>
                    {!! link_to(
                        route('forum.forums.show', $forum->forum_id),
                        osu_trans('admin.forum.forum-covers.index.forum-name', ['id' => $forum->forum_id, 'name' => $forum->forum_name])
                    ) !!}
                </h2>

                @foreach ([
                    'main' => ['cover' => $forum->cover, 'key' => 'main_cover'],
                    'default-topic' => ['cover' => $forum->cover->defaultTopicCover ?? null, 'key' => 'default_topic_cover']
                ] as $type => $cover)
                    <div class="forum-cover-admin-item__cover">
                        <h3>{{ osu_trans("admin.forum.forum-covers.index.type-title.{$type}") }}</h3>

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
                                    {{ osu_trans('admin.forum.forum-covers.index.delete') }}
                                </label>
                                <button class="btn-osu-big">{{ osu_trans('admin.forum.forum-covers.index.submit.update') }}</button>
                            {!! Form::close() !!}
                        @else
                            {{ osu_trans('admin.forum.forum-covers.index.no-cover') }}

                            {!! Form::open(['url' => route('admin.forum.forum-covers.store'), 'method' => 'POST', 'files' => true]) !!}
                                <input name="_method" value="POST" type="hidden" />
                                <input name="forum_cover[forum_id]" value="{{ $forum->forum_id }}" type="hidden" />
                                <input name="forum_cover[{{ $cover['key'] }}][cover_file]" type="file">
                                <button class="btn-osu-big">{{ osu_trans('admin.forum.forum-covers.index.submit.save') }}</button>
                            {!! Form::close() !!}
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
