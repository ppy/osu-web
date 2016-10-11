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
{a, li, span} = React.DOM

class BeatmapsetPage.HeaderTab extends React.Component
  onClick: (e) =>
    e.preventDefault()

    return if @props.currentPlaymode == @props.playmode
    $.publish 'beatmapset:beatmap:set', beatmapId: @props.newBeatmapId, playmode: @props.playmode

  render: ->
    active = @props.playmode == @props.currentPlaymode

    className = 'page-mode-link'
    className += ' page-mode-link--is-active' if active

    url = BeatmapsetPageHash.generate
      beatmapId: if active then @props.currentBeatmapId else @props.newBeatmapId
      playmode: @props.playmode

    li className: 'page-mode__item',
      a
        className: className
        onClick: @onClick
        href: url
        osu.trans "beatmaps.mode.#{@props.playmode}"

        if active
          span className: 'page-mode-link__stripe'
