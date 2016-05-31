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
{span} = React.DOM

class BeatmapsetPage.ScoreboardTab extends React.Component
  _scoreboardSwitch: =>
    $.publish 'beatmapset:scoreboard:set', scoreboard: @props.scoreboard

  render: ->
    className = 'beatmapset-scoreboard__tab'
    className += ' beatmapset-scoreboard__tab--active' if @props.scoreboard == @props.currentScoreboard

    span
      className: className
      onClick: @_scoreboardSwitch
      Lang.get "beatmaps.beatmapset.show.extra.scoreboard.#{@props.scoreboard}"
