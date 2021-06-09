{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
title: {{ $settings['title'] }}

language_tabs:
@foreach($settings['languages'] as $language)
- {{ $language }}
@endforeach

includes:
- "./prepend.md"
- "./authentication.md"
- "./groups/*"
- "./errors.md"
- "./append.md"
- "../views/docs/_notification_websocket.md"
- "../views/docs/_structures.md"
- "../views/docs/_structures/*.md"

logo: {{ $settings['logo'] ?? false }}

toc_footers:
- <a href="https://github.com/ppy/osu-web">osu-web on GitHub</a>
- <a href="https://osu.ppy.sh">osu!</a>
@if($showPostmanCollectionButton)
- <a href="{{ $postmanCollectionLink }}">View Postman collection</a>
@endif
@if($showOpenAPISpecButton)
- <a href="{{ $openAPISpecLink }}">View OpenAPI (Swagger) spec</a>
@endif
- <a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a>
