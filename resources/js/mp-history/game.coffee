# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { GameHeader } from './game-header'
import { Score } from './score'
import * as React from 'react'
import { div, span } from 'react-dom-factories'
import { formatNumber } from 'utils/html'
import { trans } from 'utils/lang'
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
      m.teamRank = if m.match.team == winningTeam then 1 else 2
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
            key: m.match.slot

      if showTeams && @props.event.game.end_time
        div {},
          div className: 'mp-history-game__team-scores',
            ['red', 'blue'].map (m) =>
              div className: "mp-history-game__team-score mp-history-game__team-score--#{m}", key: m,
                span className: 'mp-history-game__team-score-text mp-history-game__team-score-text--name', trans "matches.match.teams.#{m}"
                span className: 'mp-history-game__team-score-text mp-history-game__team-score-text--score', formatNumber(@props.teamScores[m])

          div className: 'mp-history-game__results',
            span className: 'mp-history-game__results-text', trans 'matches.match.winner', team: trans "matches.match.teams.#{winningTeam}"
            span className: 'mp-history-game__results-text mp-history-game__results-text--score', trans 'matches.match.difference', difference: formatNumber(difference)

  deletedBeatmap:
    id: null
    version: null

  deletedBeatmapset:
    id: null
    title: trans 'matches.match.beatmap-deleted'
    artist: ''
    covers:
      cover: ''
