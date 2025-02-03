{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('layout.header.admin.contest').' / '.$contest->name])

@section('content')
    <style>
        :root { {{ css_var_2x('--header-bg', $contest->header_url) }} }
    </style>

    @include('admin/_header')

    <div class="osu-page osu-page--admin">
        <div class="row">
            <div class="col-md-8">
                <dl class="dl-horizontal">
                    <dt class="admin-contest__meta-row">Contest Visible</dt>
                    <dd>{{$contest->visible ? 'yes' : 'no'}}</dd>
                    <dt class="admin-contest__meta-row">Results Visible</dt>
                    <dd>{{$contest->show_votes ? 'yes' : 'no'}}</dd>
                    <dt class="admin-contest__meta-row">Contest Type</dt>
                    <dd>{{$contest->type}}</dd>
                    <dt class="admin-contest__meta-row">Max Entries</dt>
                    <dd>{{$contest->max_entries}}</dd>
                    <dt class="admin-contest__meta-row">Max Votes</dt>
                    <dd>{{$contest->max_votes}}</dd>
                    <dt class="admin-contest__meta-row">Entry Starts</dt>
                    <dd>{{$contest->entry_starts_at}} <span class="label label-default">{!! timeago($contest->entry_starts_at) !!}</span></dd>
                    <dt class="admin-contest__meta-row">Entry Ends</dt>
                    <dd>{{$contest->entry_ends_at}} <span class="label label-default">{!! timeago($contest->entry_ends_at) !!}</span></dd>
                    <dt class="admin-contest__meta-row">Voting Starts</dt>
                    <dd>{{$contest->voting_starts_at}} <span class="label label-default">{!! timeago($contest->voting_starts_at) !!}</span></dd>
                    <dt class="admin-contest__meta-row">Voting Ends</dt>
                    <dd>{{$contest->voting_ends_at}} <span class="label label-default">{!! timeago($contest->voting_ends_at) !!}</span></dd>
                </dl>
            </div>
            <div class="col-md-4 text-right">
                <form
                    action="{{ route('admin.contests.get-zip', $contest->id) }}"
                    data-loading-overlay="0"
                    data-turbo="false"
                    method="POST"
                >
                    @csrf
                    <button class="btn-osu-big">
                        <i class="fas fa-fw fa-file-archive"></i>
                        Download all entries as ZIP
                    </button>
                </form>
            </div>
        </div>
        <dl>
            <dt class="admin-contest__meta-row">Entry Description</dt>
            <dd class="contest">
                <div class="contest__description">{!! markdown($contest->description_enter) !!}</div>
            </dd>
            <dt class="admin-contest__meta-row"><br />Voting Description</dt>
            <dd class="contest">
                <div class="contest__description">{!! markdown($contest->description_voting) !!}</div>
            </dd>
            @if ($contest->getExtraOptions() !== null)
                <dt class="admin-contest__meta-row"><br />Extra Options</dt>
                <dd><pre>{{json_encode($contest->getExtraOptions(), JSON_PRETTY_PRINT)}}</pre></dd>
            @endif

            @if ($contest->isJudged())
                <dt class="admin-contest__meta-row"><br />Judge Participation</dt>
                <dd class="contest">
                    <div class="contest__description">
                        @foreach ($contest->judges as $judge)
                            @php
                                $judgeVotesCount = $judgeVoteCounts
                                    ->where('user_id', $judge->getKey())
                                    ->first()
                                    ->judge_votes_count ?? 0;
                            @endphp

                            <div>
                                <a
                                    class="js-usercard"
                                    data-user-id="{{$judge->getKey()}}"
                                    href="{{ route('users.show', $judge) }}"
                                >{{ $judge->username }}</a>:
                                {{ $judgeVotesCount }}/{{ $contest->entries_count }}
                            </div>
                        @endforeach
                    </div>
                </dd>
            @endif
        </dl>
        <div class="js-react--admin-contest-user-entry-list"></div>
    </div>
@endsection

@section("script")
  @parent

  <script id="json-contest" type="application/json">
    {!! json_encode($contest) !!}
  </script>

  <script id="json-contest-entries" type="application/json">
    {!! json_encode($entries) !!}
  </script>

  @include('layout._react_js', ['src' => 'js/admin-contest.js'])
@stop
