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
- <a href="https://github.com/ppy/osu-web">osu-web</a>
- <a href="https://osu.ppy.sh">osu!</a>
