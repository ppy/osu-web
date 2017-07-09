###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{div, h2, p} = ReactDOMFactories
el = React.createElement

class BeatmapsetPage.Scoreboard extends React.Component
  constructor: (props) ->
    super props

    @state =
      loading: false

  setLoading: (_e, isLoading) =>
    @setState loading: isLoading

  componentDidMount: ->
    $.subscribe 'beatmapset:scoreboard:loading.beatmapsetPageScoreboard', @setLoading

  componentWillUnmount: ->
    $.unsubscribe '.beatmapsetPageScoreboard'

  render: ->
    userScoreFound = false

    className = 'beatmapset-scoreboard__main'
    className += ' beatmapset-scoreboard__main--loading' if @props.loading

    modsClassName = 'beatmapset-scoreboard__mods'
    modsClassName += ' beatmapset-scoreboard__mods--initial' if _.isEmpty @props.enabledMods

    mods = if @props.beatmap.mode == 'mania'
      ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'FI', 'HD', 'FL', '4K', '5K', '6K', '7K', '8K', '9K']
    else
      ['NM', 'EZ', 'NF', 'HT', 'HR', 'SD', 'PF', 'DT', 'NC', 'HD', 'FL', 'SO']

    div className: 'beatmapset-scoreboard',
      div className: 'page-tabs',
        for type in ['global', 'country', 'friend']
          el BeatmapsetPage.ScoreboardTab,
            key: type
            type: type
            active: @props.type == type

      if currentUser.isSupporter && @props.hasScores
        div className: 'beatmapset-scoreboard__mods-wrapper',
          div className: modsClassName,
            for mod in mods
              el BeatmapsetPage.ScoreboardMod,
                key: mod
                mod: mod
                enabled: _.includes @props.enabledMods, mod

      div className: className,
        if @props.scores.length > 0
          div {},
            div className: 'beatmap-scoreboard-top',
              div className: 'beatmap-scoreboard-top__item',
                h2 className: 'beatmap-scoreboard-top__title',
                  osu.trans('beatmapsets.show.scoreboard.score.first')
                @scoreItem score: @props.scores[0], rank: 1, itemClass: 'ScoreTop', modifiers: ['with-outline']

              if @props.userScore?
                div className: 'beatmap-scoreboard-top__item',
                  h2 className: 'beatmap-scoreboard-top__title',
                    osu.trans('beatmapsets.show.scoreboard.score.own')
                  @scoreItem score: @props.userScore, rank: @props.userScorePosition, itemClass: 'ScoreTop'

            for score, i in @props.scores[1..]
              @scoreItem
                score: score
                rank: i + 2
                itemClass:
                  if score.user.id == currentUser.id
                    'ScoreBig'
                  else
                    'Score'

        else if !@props.hasScores
          p
            className: 'beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'
            osu.trans 'beatmapsets.show.scoreboard.no_scores.unranked'

        else if currentUser.isSupporter || @props.type == 'global'
          translationKey = if @state.loading then 'loading' else @props.type

          p
            className: 'beatmapset-scoreboard__notice beatmapset-scoreboard__notice--no-scores'
            osu.trans "beatmapsets.show.scoreboard.no_scores.#{translationKey}"

        else
          div className: 'beatmapset-scoreboard__notice',
            p className: 'beatmapset-scoreboard__supporter-text', osu.trans 'beatmapsets.show.scoreboard.supporter-only'

            p
              className: 'beatmapset-scoreboard__supporter-text beatmapset-scoreboard__supporter-text--small'
              dangerouslySetInnerHTML:
                __html: osu.trans 'beatmapsets.show.scoreboard.supporter-link', link: laroute.route 'support-the-game'

  scoreItem: ({score, rank, itemClass, modifiers}) ->
    el BeatmapsetPage[itemClass],
      key: rank
      score: score
      position: rank
      playmode: @props.beatmap.mode
      countries: @props.countries
      modifiers: modifiers
