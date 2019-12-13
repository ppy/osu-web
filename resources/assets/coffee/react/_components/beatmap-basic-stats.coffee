###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

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


export BeatmapBasicStats = ({beatmap}) ->
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

      div
        className: "#{bn}__entry"
        key: stat
        title: osu.trans "beatmapsets.show.stats.#{stat}",
          if stat == 'total_length'
            hit_length: formatDuration(beatmap['hit_length'])
        div
          className: "#{bn}__entry-icon"
          style:
            backgroundImage: "url(/images/layout/beatmapset-page/#{stat}.svg)"
        span null, value
