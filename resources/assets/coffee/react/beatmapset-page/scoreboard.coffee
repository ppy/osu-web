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
{div, span} = React.DOM
el = React.createElement

class BeatmapSetPage.Scoreboard extends React.Component
  constructor: (props) ->
    super props

    @state =
      currentScoreboard: 'global'

  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:set.beatmapSetPageScoreboard', @_scoreboardSwitch

  componentWillUnmount: ->
    $.unsubscribe '.beatmapSetPageScoreboard'

  _scoreboardSwitch: (_e, scoreboard) =>
    @setState currentScoreboard: scoreboard

  scoreboards = ['global', 'country', 'friend']
  header = ['rank-header', 'player', 'score', 'accuracy']

  render: ->
    div
      className: 'page-extra beatmapset-scoreboard'
      el BeatmapSetPage.ExtraHeader, name: 'scoreboard'

      div className: 'beatmapset-scoreboard__tabs',
        scoreboards.map (m) =>
          el BeatmapSetPage.ScoreboardTab,
            key: m
            scoreboard: m
            currentScoreboard: @state.currentScoreboard

      div className: 'beatmapset-scoreboard__line'

      el BeatmapSetPage.ScoreboardFirst,
        score: @props.scores[0]

      div className: 'beatmapset-scoreboard__row',
        header.map (m) =>
          className = 'beatmapset-scoreboard__row-item beatmapset-scoreboard__row-item--header'
          className += " beatmapset-scoreboard__row-item--#{m}"

          span className: className, key: m, Lang.get "beatmaps.beatmapset.show.extra.scoreboard.list.#{m}"


      @props.scores[1..].map (s, i) =>
        el BeatmapSetPage.ScoreboardItem, score: s, position: i + 2, key: i
