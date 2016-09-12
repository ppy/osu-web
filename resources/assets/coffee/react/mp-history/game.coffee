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

class MPHistory.Game extends React.Component
  render: ->
    game = @props.event.game.data

    showTeams = game.team_type == 'team-vs' || game.team_type == 'tag-team-vs'

    className = 'mp-history-game__player-scores'
    className += ' mp-history-game__player-scores--no-teams' if !showTeams

    winningTeam = if @props.teamScores.blue > @props.teamScores.red then 'blue' else 'red'
    difference = Math.abs @props.teamScores.blue - @props.teamScores.red

    scores = game.scores.data.map (m) ->
      m.teamRank = if m.team == winningTeam then 1 else 2
      m

    scores = _.orderBy scores, ['teamRank', 'score'], ['asc', 'desc']

    div className: 'mp-history-events__game mp-history-game',
      el MPHistory.GameHeader,
        beatmap: game.beatmap?.data ? @deletedBeatmap
        beatmapset: game.beatmap?.data.beatmapset.data ? @deletedBeatmapset
        game: game

      div className: className,
        scores.map (m) =>
          el MPHistory.Score,
            score: m
            mode: game.mode
            lookupUser: @props.lookupUser
            key: m.slot

      if showTeams && @props.event.game.data.end_time
        div {},
          div className: 'mp-history-game__team-scores',
            ['blue', 'red'].map (m) =>
              div className: "mp-history-game__team-score mp-history-game__team-score--#{m}", key: m,
                span className: 'mp-history-game__team-score-text mp-history-game__team-score-text--name', Lang.get "multiplayer.match.teams.#{m}"
                span className: 'mp-history-game__team-score-text mp-history-game__team-score-text--score', @props.teamScores[m].toLocaleString()

          div className: 'mp-history-game__results',
            span className: 'mp-history-game__results-text', Lang.get 'multiplayer.match.winner', team: Lang.get "multiplayer.match.teams.#{winningTeam}"
            span className: 'mp-history-game__results-text mp-history-game__results-text--score', Lang.get 'multiplayer.match.difference', difference: difference.toLocaleString()

  deletedBeatmap:
    id: null
    version: null

  deletedBeatmapset:
    id: null
    title: osu.trans 'multiplayer.match.beatmap-deleted'
    artist: ''
    covers:
      cover: ''
