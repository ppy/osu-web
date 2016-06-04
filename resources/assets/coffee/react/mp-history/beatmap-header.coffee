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
{div, a, span, h1, h2} = React.DOM
el = React.createElement

class MPHistory.BeatmapHeader extends React.Component
  timeFormat = 'HH:mm:ss'

  render: ->
    timeStart = moment(@props.game.start_time).format timeFormat
    timeEnd = moment(@props.game.end_time).format timeFormat

    timeString = "#{timeStart} "

    if @props.game.end_time
      timeString += "- #{timeEnd}"
    else
      timeString += Lang.get 'multiplayer.match.in-progress'

    div className: 'mp-history-game__header',
      a
        className: 'mp-history-game__thumb'
        href: laroute.route 'beatmaps.show', beatmaps: @props.beatmap.id
        style:
          backgroundImage: "url(#{@props.beatmapset.covers.card})"

        div className: 'mp-history-game__stats-box',
          span className: 'mp-history-game__stat', "##{@props.game.id.toLocaleString()}"
          span className: 'mp-history-game__stat', timeString

        div className: 'mp-history-game__metadata-box',
          h1 className: 'mp-history-game__metadata mp-history-game__metadata--title', @props.beatmapset.title
          h2 className: 'mp-history-game__metadata mp-history-game__metadata--artist', @props.beatmapset.artist

        div className: 'mp-history-game__mods-box',
          el Mods, mods: @props.game.mods
