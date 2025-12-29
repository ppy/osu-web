@extends('master', [
    'titleOverride' => "osu!wrapped 2025: {$summary->user->username}",
    'blank' => 'true',
    'bodyAdditionalClasses' => 'osu-layout--wrapped'
])

@section('content')
    <script id="json-wrapped-show" type="application/json">
        {!! json_encode($json) !!}
    </script>
    <div class="js-react u-contents" data-react="wrapped-show"></div>

    @include('layout._react_js', ['src' => 'js/wrapped-show.js'])
@endsection
