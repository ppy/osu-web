{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', [
    'titlePrepend' => $topic->topic_title,
])

@section('content')
    @include('forum.topics._floating_header')
    @include('forum._header', [
        'additionalLinks' => [
            [
                'title' => $topic->topic_title,
                'url' => route('forum.topics.show', $topic->getKey()),
            ],
            [
                'title' => osu_trans('forum.topic.logs._'),
            ]
        ],
        'forum' => $topic->forum,
        'topic' => $topic,
    ])

    <div class="osu-page osu-page--generic osu-page--full">
        @if ($logs->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th class="forum-topic-logs-table__header">{{ osu_trans('forum.topic.logs.columns.date') }}</th>
                        <th class="forum-topic-logs-table__header">{{ osu_trans('forum.topic.logs.columns.user') }}</th>
                        <th class="forum-topic-logs-table__header">{{ osu_trans('forum.topic.logs.columns.action') }}</th>
                    </tr>
                </thead>

                <tbody class="forum-topic-logs-table__body">
                    @foreach ($logs as $log)
                        @php
                            $dataForDisplay = $log->dataForDisplay();
                        @endphp

                        <tr class="forum-topic-logs-table__row">
                            <td class="forum-topic-logs-table__col forum-topic-logs-table__col--date">{!! timeago($log->log_time) !!}</td>
                            <td class="forum-topic-logs-table__col">
                                <a
                                    class="js-usercard"
                                    data-user-id="{{$log->user->getKey()}}"
                                    href="{{ route('users.show', $log->user) }}"
                                >
                                    {{ $log->user->username }}
                                </a>
                            </td>
                            <td class="forum-topic-logs-table__col forum-topic-logs-table__col--action">
                                {{ osu_trans("forum.topic.logs.operations.{$log->translationKey()}") }}

                                @if ($dataForDisplay !== null)
                                    <div class="forum-topic-logs-table__log-data">
                                        @if ($dataForDisplay['url'] !== null)
                                            <a href="{{ $dataForDisplay['url'] }}">
                                                {!! $dataForDisplay['text'] !!}
                                            </a>
                                        @else
                                            {!! $dataForDisplay['text'] !!}
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            {{ osu_trans('forum.topic.logs.no_results') }}
        @endif

        @include('objects._pagination_v2', ['object' => $logs])
    </div>
@endsection
