# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span } from 'react-dom-factories'

bn = 'beatmap-basic-stats'

# value is in second
formatDuration = (value) ->
  s = value % 60
  m = Math.floor(value / 60) % 60
  h = Math.floor(value / 3600)

  if h > 0
    "#{h}:#{_.padStart m, 2, 0}:#{_.padStart s, 2, 0}"
  else
    "#{m}:#{_.padStart s, 2, 0}"


export BeatmapBasicStats = ({beatmap, beatmapset}) ->
  div
    className: bn
    for stat in ['total_length', 'bpm', 'count_circles', 'count_sliders']
      value = beatmap[stat]

      value =
        if stat == 'bpm'
          if value > 1000 then '∞' else osu.formatNumber(value)
        else if stat == 'total_length'
          formatDuration value
        else
          osu.formatNumber(value)

      title =
        osu.trans "beatmapsets.show.stats.#{stat}",
          if stat == 'total_length'
            hit_length: formatDuration(beatmap['hit_length'])

      if stat == 'bpm' && beatmapset.offset != 0
        title += " (#{osu.trans 'beatmapsets.show.stats.offset'}: #{beatmapset.offset})"

      div
        className: "#{bn}__entry"
        key: stat
        title: title
        div
          className: "#{bn}__entry-icon"
          style:
            backgroundImage: "url(/images/layout/beatmapset-page/#{stat}.svg)"
        span null, value
