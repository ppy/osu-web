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

class BeatmapsetPage.Scoreboard extends React.Component
  constructor: (props) ->
    super props

    @state =
      loading: false

  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:loading.beatmapSetPageScoreboard', @_setLoading

  componentWillUnmount: ->
    $.unsubscribe '.beatmapSetPageScoreboard'

  _setLoading: (_e, isLoading) =>
    @setState loading: isLoading

  _scores: ->
    elements = ['rank-header', 'player-header', 'score', 'accuracy']

    div {},
      el BeatmapsetPage.ScoreboardFirst,
        score: @props.scores[0]
        countries: @props.countries

      if @props.scores.length > 1
        div className: 'beatmapset-scoreboard__row',
          elements.map (m) =>
            span
              className: "beatmapset-scoreboard__row-item beatmapset-scoreboard__row-item--#{m} beatmapset-scoreboard__row-item--header"
              key: m
              Lang.get "beatmaps.beatmapset.show.extra.scoreboard.list.#{m}"

      @props.scores[1..].map (s, i) =>
        el BeatmapsetPage.ScoreboardItem, score: s, position: i + 2, countries: @props.countries, key: i


  render: ->
    scoreboards = ['global', 'country', 'friend']

    className = 'beatmapset-scoreboard__main'
    className += ' beatmapset-scoreboard__main--loading' if @state.loading

    div
      className: 'page-extra beatmapset-scoreboard'
      el BeatmapsetPage.ExtraHeader, name: 'scoreboard'

      if @props.scores.length == 0 and @props.currentScoreboard == 'global'
        p
          className: 'beatmapset-scoreboard__no-scores'
          Lang.get 'beatmaps.beatmapset.show.extra.scoreboard.no-scores.global'
      else
        div {},
          if not _.isEmpty currentUser
            div {},
              div className: 'beatmapset-scoreboard__tabs',
                scoreboards.map (m) =>
                  el BeatmapsetPage.ScoreboardTab,
                    key: m
                    scoreboard: m
                    currentScoreboard: @props.currentScoreboard

              div className: 'beatmapset-scoreboard__line'

          div className: className,
            if @props.currentScoreboard != 'global'
              if currentUser.isSupporter == false
                div className: 'beatmapset-scoreboard__notice',
                  p
                    className: 'beatmapset-scoreboard__supporter-text'
                    Lang.get 'beatmaps.beatmapset.show.extra.scoreboard.supporter-only'
                  p
                    className: 'beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'
                    dangerouslySetInnerHTML:
                      __html: Lang.get 'beatmaps.beatmapset.show.extra.scoreboard.supporter-link', link: laroute.route 'support-the-game'
              else if @props.scores.length == 0
                div className: 'beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores',
                  Lang.get "beatmaps.beatmapset.show.extra.scoreboard.no-scores.#{@props.currentScoreboard}"
              else
                @_scores()
            else
              @_scores()
