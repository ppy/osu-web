{{--
    Copyright 2015-2017 ppy Pty. Ltd.

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
@extends('master', [
    'title' => $contest->name,
    'bodyAdditionalClasses' => 'osu-layout--body-dark'
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

    <div class="osu-page osu-page--generic">
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
                <button
                    data-remote="true"
                    data-method="POST"
                    data-url="{{ route('admin.contests.get-zip', $contest->id) }}"
                    class="btn btn-primary"
                >
                    <i class="fas fa-fw fa-file-archive"></i>
                    Download all entries as ZIP
                </button>
            </div>
        </div>
        <dl>
            <dt class="admin-contest__meta-row">Entry Description</dt>
            <dd class="contest">
                <div class="contest__description">{!! Markdown::convertToHtml($contest->description_enter) !!}</div>
            </dd>
            <dt class="admin-contest__meta-row">Voting Description</dt>
            <dd class="contest">
                <div class="contest__description">{!! Markdown::convertToHtml($contest->description_voting) !!}</div>
            </dd>
            @if ($contest->extra_options !== null)
                <dt class="admin-contest__meta-row">Extra Options</dt>
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
