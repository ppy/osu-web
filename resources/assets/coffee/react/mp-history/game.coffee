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

import { GameHeader } from './game-header'
import { Score } from './score'
import * as React from 'react'
import { div, span } from 'react-dom-factories'
el = React.createElement

export class Game extends React.Component
  render: ->
    game = @props.event.game

    showTeams = game.team_type == 'team-vs' || game.team_type == 'tag-team-vs'

    className = 'mp-history-game__player-scores'
    className += ' mp-history-game__player-scores--no-teams' if !showTeams

    winningTeam = if @props.teamScores.blue > @props.teamScores.red then 'blue' else 'red'
    difference = Math.abs @props.teamScores.blue - @props.teamScores.red

    scores = game.scores.map (m) ->
      m.teamRank = if m.multiplayer.team == winningTeam then 1 else 2
      m

    scores = _.orderBy scores, ['teamRank', 'score'], ['asc', 'desc']

    div className: 'mp-history-game',
      el GameHeader,
        beatmap: game.beatmap ? @deletedBeatmap
        beatmapset: game.beatmap?.beatmapset ? @deletedBeatmapset
        game: game

      div className: className,
        scores.map (m) =>
          el Score,
            score: m
            mode: game.mode
            users: @props.users
            key: m.multiplayer.slot

      if showTeams && @props.event.game.end_time
        div {},
          div className: 'mp-history-game__team-scores',
            ['red', 'blue'].map (m) =>
              div className: "mp-history-game__team-score mp-history-game__team-score--#{m}", key: m,
                span className: 'mp-history-game__team-score-text mp-history-game__team-score-text--name', osu.trans "multiplayer.match.teams.#{m}"
                span className: 'mp-history-game__team-score-text mp-history-game__team-score-text--score', osu.formatNumber(@props.teamScores[m])

          div className: 'mp-history-game__results',
            span className: 'mp-history-game__results-text', osu.trans 'multiplayer.match.winner', team: osu.trans "multiplayer.match.teams.#{winningTeam}"
            span className: 'mp-history-game__results-text mp-history-game__results-text--score', osu.trans 'multiplayer.match.difference', difference: osu.formatNumber(difference)

  deletedBeatmap:
    id: null
    version: null

  deletedBeatmapset:
    id: null
    title: osu.trans 'multiplayer.match.beatmap-deleted'
    artist: ''
    covers:
      cover: ''
