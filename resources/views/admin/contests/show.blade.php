{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('admin/master', [
    'title' => $contest->name,
])

@section('content')
    @include('objects.css-override', ['mapping' => [
        '.osu-page-header-v2--contests' => $contest->header_url,
    ]])

    <div class="osu-page">
        <div class="osu-page-header-v2 osu-page-header-v2--contests">
            <div class="osu-page-header-v2__overlay"></div>
            <div class="osu-page-header-v2__title">{{$contest->name}}</div>
        </div>
    </div>

    <div class="osu-layout__row osu-layout__row--page-admin">
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
                {!! Form::open([
                    'route' => ['admin.contests.get-zip', $contest->id],
                    'method' => 'POST'
                ]) !!}
                    <button class="btn-osu-big">
                        <i class="fas fa-fw fa-file-archive"></i>
                        Download all entries as ZIP
                    </button>
                {!! Form::close() !!}
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
            @if ($contest->extra_options !== null)
                <dt class="admin-contest__meta-row"><br />Extra Options</dt>
                <dd><pre>{{json_encode($contest->extra_options, JSON_PRETTY_PRINT)}}</pre></dd>
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

  @include('layout._extra_js', ['src' => 'js/react/admin/contest.js'])
@stop
