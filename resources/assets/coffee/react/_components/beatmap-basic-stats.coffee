###
# Copyright 2015-2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, span} = React.DOM

bn = 'beatmap-basic-stats'

# value is in second
formatDuration = (value) ->
  duration = moment(value * 1000).utcOffset(0)

  format =
    if duration.hours() > 0
      'h:mm:ss'
    else
      'm:ss'

  duration.format format


@BeatmapBasicStats = ({beatmapset, beatmap}) ->
  div
    className: bn
    for stat in ['total_length', 'bpm', 'count_circles', 'count_sliders']
      value =
        if stat == 'bpm'
          beatmapset.bpm
        else
          beatmap[stat]

      value =
        if stat == 'total_length'
          formatDuration value
        else
          value.toLocaleString()

      div
        className: "#{bn}__entry"
        key: stat
        title: osu.trans "beatmaps.beatmapset.show.stats.#{stat}"
        div
          className: "#{bn}__entry-icon"
          style:
            backgroundImage: "url(/images/layout/beatmapset-page/#{stat}.svg)"
        span null, value
