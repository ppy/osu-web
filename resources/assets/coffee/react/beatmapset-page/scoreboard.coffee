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

class BeatmapSetPage.Scoreboard extends React.Component
  constructor: (props) ->
    super props

    @state =
      loading: false

  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:loading.beatmapSetPageScoreboard', @_setLoading

  componentWillUnmount: ->
    $.unsubscribe '.beatmapSetPageScoreboard'

  scoreboards = ['global', 'country', 'friend']
  header = ['rank-header', 'player', 'score', 'accuracy']

  _setLoading: (_e, isLoading) =>
    @setState loading: isLoading

  _scores: ->
    div {},
      el BeatmapSetPage.ScoreboardFirst,
        score: @props.scores[0]
        countries: @props.countries

      if @props.scores.length > 1
        div className: 'beatmapset-scoreboard__row',
          header.map (m) =>
            className = 'beatmapset-scoreboard__row-item beatmapset-scoreboard__row-item--header'
            className += " beatmapset-scoreboard__row-item--#{m}"

            span className: className, key: m, Lang.get "beatmaps.beatmapset.show.extra.scoreboard.list.#{m}"

      @props.scores[1..].map (s, i) =>
        el BeatmapSetPage.ScoreboardItem, score: s, position: i + 2, countries: @props.countries, key: i


  render: ->
    className = 'beatmapset-scoreboard__main'
    className += ' beatmapset-scoreboard__main--loading' if @state.loading

    div
      className: 'page-extra beatmapset-scoreboard'
      el BeatmapSetPage.ExtraHeader, name: 'scoreboard'

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
                  el BeatmapSetPage.ScoreboardTab,
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
                      __html: Lang.get 'beatmaps.beatmapset.show.extra.scoreboard.supporter-link', link: Url.support
              else if @props.scores.length == 0
                div className: 'beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores',
                  Lang.get "beatmaps.beatmapset.show.extra.scoreboard.no-scores.#{@props.currentScoreboard}"
              else
                @_scores()
            else
              @_scores()
