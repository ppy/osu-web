{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
title: API Reference

language_tabs:
@foreach($settings['languages'] as $language)
- {{ $language }}
@endforeach

includes:
- notification_websocket
- structures

search: true

toc_footers:
- <a href="https://github.com/ppy/osu-web">osu-web on GitHub</a>
- <a href="https://osu.ppy.sh">osu!</a>
