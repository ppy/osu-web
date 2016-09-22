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
{img} = React.DOM

class BeatmapsetPage.ScoreboardMod extends React.Component
  onClick: =>
    $.publish 'beatmapset:scoreboard:set', enabledMod: @props.mod

  onMouseEnter: =>
    $.publish 'beatmapset:mod:hover', @props.mod

  onMouseLeave: ->
    $.publish 'beatmapset:mod:hover', null

  render: ->
    enabled = _.isEmpty(@props.enabledMods) ||
      _.includes(@props.enabledMods, @props.mod)

    if @props.hoveredMod && @props.mod != @props.hoveredMod && _.isEmpty @props.enabledMods
      enabled = false

    modName = osu.trans "beatmaps.mods.#{@props.mod}"
    className = 'beatmapset-scoreboard__mod'
    className += ' beatmapset-scoreboard__mod--enabled' if enabled

    img _.extend
      className: className
      title: modName
      onClick: @onClick
      onMouseEnter: @onMouseEnter
      onMouseLeave: @onMouseLeave
      osu.src2x "/images/badges/mods/#{_.kebabCase modName}.png"
