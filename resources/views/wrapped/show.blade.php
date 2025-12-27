@extends('master', [
    'titleOverride' => osu_trans('home.landing.title'),
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
