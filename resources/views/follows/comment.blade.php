{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@extends('master', ['titlePrepend' => osu_trans('follows.comment.page_title')])

@section('content')
    <div class="js-react u-contents" data-react="follows-comment"></div>

    <script id="json-follows-comment" type="application/json">
        {!! json_encode($followsJson) !!}
    </script>

    @include('layout._react_js', ['src' => 'js/follows-comment.js'])
@endsection
