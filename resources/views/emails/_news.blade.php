{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
# {!! osu_trans('notifications.mail.news') !!}
@foreach ($news as $series => $items)

## {!! osu_trans("news.series.{$series}") !!}

@foreach ($items as $details)
### {!! $details['title'] !!}
{!! $details['link'] !!}

@endforeach
@endforeach
---
