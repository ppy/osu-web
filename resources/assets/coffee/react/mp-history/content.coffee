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
{div} = React.DOM
el = React.createElement

class MPHistory.Content extends React.Component
  teamScores: (eventIndex) ->
    @scoresCache ?= {}

    if !@scoresCache[eventIndex]?
      left = 0
      right = 0

      for score in @props.events[eventIndex].game.data.scores.data
        if score.team == 0
          left += score.score
        else
          right += score.score

      @scoresCache[eventIndex] =
        left: left
        right: right

    return @scoresCache[eventIndex]

  render: ->
    # TODO: write proper displaying logic
    div className: 'osu-layout__row osu-layout__row--page-mp-history',
      if !_.isEmpty @props.events
        event = _.find @props.events, (o) -> o.game? && !_.isEmpty o.game.data.mods

        el MPHistory.Game,
          event: event
          countries: @props.countries
          teamScores: @teamScores @props.events.indexOf event
