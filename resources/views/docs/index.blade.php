{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $mdFiles = [
        resource_path('views/docs/_using_chat.md'),
        resource_path('views/docs/_websocket.md'),
        resource_path('views/docs/_websocket_events.md'),
        resource_path('views/docs/_websocket_commands.md'),
        resource_path('views/docs/_structures.md'),
        ...glob(resource_path('views/docs/_structures/*.md')),
    ];
    $parser = Parsedown::instance();
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{!! $metadata['title'] !!}</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ unmix('css/docs.css') }}">

    <style>
        @foreach($metadata['example_languages'] as $lang)
            body .content .{{ $lang }}-example code {
                display: none;
            }
            body[data-language={{ $lang }}] .content .{{ $lang }}-example code {
                display: block;
            }
            body[data-language={{ $lang }}] .lang-button[data-language-name={{ $lang }}] {
                --bg: var(--bg-active);
            }
        @endforeach
    </style>

    <script src="{{ unmix('js/runtime.js') }}"></script>
    <script src="{{ unmix('js/vendor.js') }}"></script>
    <script src="{{ unmix('js/commons.js') }}"></script>
    <script src="{{ unmix('js/docs.js') }}"></script>
</head>

<body data-languages="{{ json_encode($metadata['example_languages'] ?? []) }}">

@include("docs.sidebar")

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        @include('docs.info')
        @include('docs.auth')
        @include("docs.groups")

        @foreach ($mdFiles as $file)
            {!! $parser->text(file_get_contents($file)) !!}
        @endforeach
    </div>
    <div class="dark-box">
        <div class="lang-selector">
            @foreach($metadata['example_languages'] as $lang)
                <button type="button" class="lang-button js-set-language" data-language-name="{{ $lang }}">{{ $lang }}</button>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
