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

bn = 'beatmapset-scoreboard'

BeatmapsetPage.Scoreboard = React.createClass
  getInitialState: ->
    loading: false


  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:loading.beatmapSetPageScoreboard', @setLoading


  componentWillUnmount: ->
    $.unsubscribe '.beatmapSetPageScoreboard'


  render: ->
    scoreboards = ['global', 'country', 'friend']
    className = "#{bn}__main"
    className += " #{bn}__main--loading" if @state.loading

    div
      className: "page-extra #{bn}"
      el BeatmapsetPage.ExtraHeader, name: 'scoreboard'

      if currentUser.id?
        div null,
          div
            className: "#{bn}__tabs"
            scoreboards.map (m) =>
              el BeatmapsetPage.ScoreboardTab,
                key: m
                scoreboard: m
                currentScoreboard: @props.currentScoreboard

          div className: "#{bn}__line"

      div className: className,
        if @props.scores.length > 0
          @scores()

        else if currentUser.isSupporter || @props.currentScoreboard == 'global'
          translationKey = if @state.loading then 'loading' else @props.currentScoreboard
          p
            className: "#{bn}__notice #{bn}__notice--no-scores #{bn}__notice--#{'guest' if !currentUser.id?}"
            Lang.get "beatmaps.beatmapset.show.extra.scoreboard.no-scores.#{translationKey}"

        else
          div className: "#{bn}__notice",
            p
              className: "#{bn}__supporter-text"
              Lang.get "beatmaps.beatmapset.show.extra.scoreboard.supporter-only"
            p
              className: "#{bn}__supporter-text #{bn}__supporter-text--small"
              dangerouslySetInnerHTML:
                __html: Lang.get 'beatmaps.beatmapset.show.extra.scoreboard.supporter-link', link: laroute.route 'support-the-game'


  setLoading: (_e, isLoading) ->
    @setState loading: isLoading


  scoreItem: (score, rank) ->
    componentName = if rank == 1 then 'ScoreboardFirst' else 'ScoreboardItem'

    el BeatmapsetPage[componentName],
      key: rank
      position: rank
      score: score
      countries: @props.countries


  scores: ->
    return if @props.scores.length == 0

    div null,
      @scoreItem @props.scores[0], 1

      if @props.scores.length > 1
        div
          className: "#{bn}__row"
          key: 'header'
          ['rank-header', 'player-header', 'score', 'accuracy'].map (m) =>
            className = "#{bn}__row-item #{bn}__row-item--#{m} #{bn}__row-item--header"
            className += ' hidden-xs' if m == 'accuracy'

            span
              className: "#{bn}__row-item #{bn}__row-item--#{m} #{bn}__row-item--header"
              key: m
              Lang.get "beatmaps.beatmapset.show.extra.scoreboard.list.#{m}"

      @props.scores.map (score, i) =>
        return if i == 0

        @scoreItem score, i + 1
