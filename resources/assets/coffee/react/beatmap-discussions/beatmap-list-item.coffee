###
# Copyright 2015 ppy Pty. Ltd.
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
{div} = React.DOM
el = React.createElement

bn = 'beatmap-list-item'

BeatmapDiscussions.BeatmapListItem = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    topClasses = bn
    topClasses += " #{bn}--large" if @props.large

    version = if @props.beatmap.mode == 'mania'
      "[#{@props.beatmap.difficulty_size}k] #{@props.beatmap.version}"
    else
      @props.beatmap.version

    div
      className: topClasses

      div className: "#{bn}__col",
        el BeatmapIcon,
          beatmap: @props.beatmap
          modifier: "#{'large' if @props.large}"
          overrideVersion: 'hard' if @props.mode == 'mode'

      div className: "#{bn}__col #{bn}__col--main",
        if @props.mode == 'complete'
          [
            div key: 'version',
              version
            div
              key: 'mode'
              className: "#{bn}__small"
              osu.trans("beatmaps.mode.#{@props.beatmap.mode}")
          ]

        else if @props.mode == 'mode'
          osu.trans("beatmaps.mode.#{@props.beatmap.mode}")

        else if @props.mode == 'version'
          version

      if @props.withButton?
        div className: "#{bn}__col",
          el Icon, name: "chevron-#{@props.withButton}"
