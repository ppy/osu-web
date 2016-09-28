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
{div, span, p} = React.DOM
el = React.createElement

bn = 'ranking-scoreboard'

RankingPage.Scoreboard = React.createClass
  getInitialState: ->
    loading: false


  componentDidMount: ->
    $.subscribe 'ranking:scoreboard:loading.rankingPageScoreboard', @setLoading


  componentWillUnmount: ->
    $.unsubscribe '.rankingPageScoreboard'


  render: ->
    scoreboards = BeatmapHelper.modes
    className = "#{bn}__main"
    className += " #{bn}__main--loading" if @state.loading
    translationKey = if @state.loading then 'loading' else 'no-scores'
    div
      className: "page-extra #{bn}"

      if currentUser.id?
        div null,
          div
            className: "#{bn}__tabs"
            scoreboards.map (m) =>
              el RankingPage.ScoreboardTab,
                key: m
                scoreboard: m
                currentScoreboard: @props.currentScoreboard

          div className: "#{bn}__line"

      div className: className,
        if @props.scores.length > 0
          @scores()
        else
          p
            className: "#{bn}__notice #{bn}__notice--no-scores #{bn}__notice--#{'guest' if !currentUser.id?}"
            osu.trans "ranking.overall.#{translationKey}"


  setLoading: (_e, isLoading) ->
    @setState loading: isLoading


  scoreItem: (score, rank) ->
    componentName = 'ScoreboardItem'
    el RankingPage[componentName],
      key: rank
      position: rank
      score: score
      countries: @props.countries
      mode: @props.currentScoreboard


  scores: ->
    return if @props.scores.length == 0

    div null,

      if @props.scores.length > 0
        div
          className: "#{bn}__row"
          key: 'header'
          ['rank-header', 'player-header', 'accuracy', 'play-count', 'score', 'x-count', 's-count', 'a-count'].map (m) =>
            className = "#{bn}__row-item #{bn}__row-item--#{m} #{bn}__row-item--header"
            className += ' hidden-xs' if m == 'play-count' || m == 'x-count' || m == 's-count' || m == 'a-count'

            span
              className: className
              key: m
              osu.trans "ranking.list.#{m}"

      @props.scores.map (score, i) =>
        @scoreItem score, i + 1
