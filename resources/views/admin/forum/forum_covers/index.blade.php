{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('admin.forum.forum-covers.index.title')])

@section('content')
    @include('admin/_header')

    <div class="osu-page osu-page--admin">
        @foreach ($forums as $forum)
            @php
                $forumId = $forum->getKey();
                $forumCover = $forum->cover;
            @endphp
            <div class="forum-cover-admin-item" id="forum-{{ $forumId }}">
                <h2>
                    {!! link_to(
                        route('forum.forums.show', $forumId),
                        osu_trans('admin.forum.forum-covers.index.forum-name', ['id' => $forumId, 'name' => $forum->forum_name])
                    ) !!}
                </h2>

                @foreach ([
                    'main' => ['cover' => $forumCover?->file(), 'key' => 'main_cover'],
                    'default-topic' => ['cover' => $forumCover?->defaultTopicCover, 'key' => 'default_topic_cover']
                ] as $type => $cover)
                    <div class="forum-cover-admin-item__cover">
                        <h3>{{ osu_trans("admin.forum.forum-covers.index.type-title.{$type}") }}</h3>

                        @if ($cover['cover'] !== null && $cover['cover']->url() !== null)
                            <div class="forum-cover-admin-item__cover-image"
                                style="background-image:url('{{ $cover['cover']->url() }}')"
                            ></div>

                            <form
                                action="{{ route('admin.forum.forum-covers.update', $cover['cover']->model->getKey()) }}"
                                enctype="multipart/form-data"
                                method="POST"
                            >
                                @csrf
                                <input name="_method" value="PUT" type="hidden" />
                                <input name="forum_cover[{{ $cover['key'] }}][cover_file]" type="file">

                                <label>
                                    <input name="forum_cover[{{ $cover['key'] }}][_delete]" value="1" type="checkbox" />
                                    {{ osu_trans('admin.forum.forum-covers.index.delete') }}
                                </label>
                                <button class="btn-osu-big">{{ osu_trans('admin.forum.forum-covers.index.submit.update') }}</button>
                            </form>
                        @else
                            {{ osu_trans('admin.forum.forum-covers.index.no-cover') }}

                            <form
                                action="{{ route('admin.forum.forum-covers.store') }}"
                                enctype="multipart/form-data"
                                method="POST"
                            >
                                @csrf
                                <input name="_method" value="POST" type="hidden" />
                                <input name="forum_cover[forum_id]" value="{{ $forumId }}" type="hidden" />
                                <input name="forum_cover[{{ $cover['key'] }}][cover_file]" type="file">
                                <button class="btn-osu-big">{{ osu_trans('admin.forum.forum-covers.index.submit.save') }}</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
