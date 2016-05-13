###
# Copyright 2016 ppy Pty. Ltd.
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
{div, hr} = React.DOM
el = React.createElement

class BeatmapsetPage.Stats extends React.Component
  render: ->
    elements = ['cs', 'hp', 'od', 'ar', 'stars', 'length', 'bpm']

    div className: 'page-contents__content',
      div null,
        elements.map (m) =>
          dt = Lang.get "beatmaps.beatmapset.show.stats.#{m}"

          switch m
            when 'cs'
              dd = "#{@props.beatmap.cs.toLocaleString()}"
            when 'hp'
              dd = "#{@props.beatmap.drain.toLocaleString()}"
            when 'od'
              dd = "#{@props.beatmap.accuracy.toLocaleString()}"
            when 'ar'
              dd = "#{@props.beatmap.ar.toLocaleString()}"
            when 'stars'
              dd = "#{@props.beatmap.difficulty_rating.toFixed 2}"
            when 'length'
              dd = moment 0
                .seconds @props.beatmap.total_length
                .format 'm:ss'
            when 'bpm'
              dd = @props.beatmapset.bpm

          el 'dl', className: 'beatmapset-stats__stat', key: m,
            el 'dt', className: 'beatmapset-stats__stat-key', dt
            el 'dd', className: 'beatmapset-stats__stat-value', dd

      hr className: 'beatmapset-stats__line'

      div null,
        if @props.beatmapset.source
          el 'dl', className: 'beatmapset-stats__stat beatmapset-stats__stat--full',
            el 'dt', className: 'beatmapset-stats__stat-key', Lang.get 'beatmaps.beatmapset.show.stats.source'
            el 'dd', className: 'beatmapset-stats__stat-value beatmapset-stats__stat-value--light', @props.beatmapset.source

        if @props.beatmapset.tags
          el 'dl', className: 'beatmapset-stats__stat beatmapset-stats__stat--full',
            el 'dt', className: 'beatmapset-stats__stat-key', Lang.get 'beatmaps.beatmapset.show.stats.tags'
            el 'dd', className: 'beatmapset-stats__stat-value beatmapset-stats__stat-value--light', @props.beatmapset.tags
