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
        <div class="admin-contest">
            <div class="admin-contest__toolbar">
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
            <div class="admin-contest__meta">
                <div class="admin-contest__meta-title">Contest Visible</div>
                <div>{{$contest->visible ? 'yes' : 'no'}}</div>
                <div class="admin-contest__meta-title">Results Visible</div>
                <div>{{$contest->show_votes ? 'yes' : 'no'}}</div>
                <div class="admin-contest__meta-title">Contest Type</div>
                <div>{{$contest->type}}</div>
                <div class="admin-contest__meta-title">Max Entries</div>
                <div>{{$contest->max_entries}}</div>
                <div class="admin-contest__meta-title">Max Votes</div>
                <div>{{$contest->max_votes}}</div>
                <div class="admin-contest__meta-title">Entry Starts</div>
                <div>{{$contest->entry_starts_at}} <span class="label label-default">{!! timeago($contest->entry_starts_at) !!}</span></div>
                <div class="admin-contest__meta-title">Entry Ends</div>
                <div>{{$contest->entry_ends_at}} <span class="label label-default">{!! timeago($contest->entry_ends_at) !!}</span></div>
                <div class="admin-contest__meta-title">Voting Starts</div>
                <div>{{$contest->voting_starts_at}} <span class="label label-default">{!! timeago($contest->voting_starts_at) !!}</span></div>
                <div class="admin-contest__meta-title">Voting Ends</div>
                <div>{{$contest->voting_ends_at}} <span class="label label-default">{!! timeago($contest->voting_ends_at) !!}</span></div>
            </div>
            <div>
                <div class="admin-contest__title">Entry Description</div>
                <div class="admin-contest__description">{!! markdown($contest->description_enter) !!}</div>
            </div>
            <div>
                <div class="admin-contest__title">Voting Description</div>
                <div class="admin-contest__description">{!! markdown($contest->description_voting) !!}</div>
            </div>

            @if ($contest->getExtraOptions() !== null)
                <div>
                    <div class="admin-contest__title">Extra Options</div>
                    <div><pre>{{json_encode($contest->getExtraOptions(), JSON_PRETTY_PRINT)}}</pre></div>
                </div>
            @endif

            @if ($contest->isJudged())
                <div>
                    <div class="admin-contest__title">Judge Participation</div>
                    <div class="admin-contest__description">
                        @foreach ($contest->judges as $judge)
                            @php
                                $judgeVoteCount = $judgeVoteCounts[$judge->getKey()]->judge_vote_count ?? 0;
                            @endphp
                            <div>
                                <a
                                    class="js-usercard"
                                    data-user-id="{{$judge->getKey()}}"
                                    href="{{ route('users.show', $judge) }}"
                                >{{ $judge->username }}</a>:
                                {{ $judgeVoteCount }}/{{ $contest->entries_count }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="js-react--admin-contest-user-entry-list"></div>
        </div>
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
