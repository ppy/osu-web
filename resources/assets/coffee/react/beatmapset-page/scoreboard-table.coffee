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

{a, button, div, i, span, table, tr, td, th, thead, tbody} = ReactDOMFactories
el = React.createElement
bn = 'beatmap-scoreboard-table'

BeatmapsetPage.ScoreboardTable = (props) ->
  props.scores = props.scores.map (score) ->
    score.reportButton =
      if score.userReportPresence.reported
        span className: 'report-button',
          span null,
            i className: 'fas fa-exclamation-triangle'
            span className: 'report-button__text',
              osu.trans('beatmapsets.show.scoreboard.score.reported')
      else
        button
          className: 'report-button report-button--enabled'
          key: 'button'
          type: 'button'
          onClick: (e) ->
            return if e.button != 0
            e.preventDefault()

            $.publish 'user:report',
              score: score
              mode: props.beatmap.mode
          span null,
            i className: 'fas fa-exclamation-triangle'
            span className: 'report-button__text',
              osu.trans('beatmapsets.show.scoreboard.score.report')
    score

  div className: "#{bn}",
    table
      className: "#{bn}__table"
      thead {},
        tr {},
          th className: "#{bn}__header #{bn}__header--rank", osu.trans('beatmapsets.show.scoreboard.headers.rank')
          th className: "#{bn}__header #{bn}__header--grade", ''
          th className: "#{bn}__header #{bn}__header--score", osu.trans('beatmapsets.show.scoreboard.headers.score')
          th className: "#{bn}__header #{bn}__header--accuracy", osu.trans('beatmapsets.show.scoreboard.headers.accuracy')
          th className: "#{bn}__header #{bn}__header--flag", ''
          th className: "#{bn}__header #{bn}__header--player", osu.trans('beatmapsets.show.scoreboard.headers.player')
          th className: "#{bn}__header #{bn}__header--maxcombo", osu.trans('beatmapsets.show.scoreboard.headers.combo')
          for stat in props.hitTypeMapping
            th key: stat[0], className: "#{bn}__header #{bn}__header--hitstat", stat[0]
          th className: "#{bn}__header #{bn}__header--miss", osu.trans('beatmapsets.show.scoreboard.headers.miss')
          th className: "#{bn}__header #{bn}__header--pp", osu.trans('beatmapsets.show.scoreboard.headers.pp')
          th className: "#{bn}__header #{bn}__header--mods", osu.trans('beatmapsets.show.scoreboard.headers.mods')
          th className: "#{bn}__header #{bn}__header--report", ''

      tbody className: "#{bn}__body",
        for score, index in props.scores
          rowClasses = "#{bn}__body-row"

          if index == 0
            rowClasses += " #{bn}__body-row--first"

          if props.scoreboardType != 'friend' && osu.currentUserIsFriendsWith(score.user.id)
            rowClasses += " #{bn}__body-row--friend"

          if score.user.id == currentUser.id
            rowClasses += " #{bn}__body-row--self"

          tr
            className: rowClasses
            key: index,

            td className: "#{bn}__rank", "##{index+1}"

            td className: "#{bn}__grade",
              div className: "badge-rank badge-rank--tiny badge-rank--#{score.rank}"

            td className: "#{bn}__score",
              score.score.toLocaleString()

            td className: (if score.accuracy == 1 then "#{bn}__perfect" else ''),
              "#{(score.accuracy * 100).toFixed(2)}%"

            td {},
              if score.user.country_code
                a
                  href: laroute.route 'rankings',
                    mode: props.beatmap.mode
                    country: score.user.country_code
                    type: 'performance'
                  el FlagCountry,
                    country: props.countries[score.user.country_code]
                    classModifiers: ['scoreboard', 'small-box']
            td {},
              a
                className: "#{bn}__user-link js-usercard"
                'data-user-id': score.user.id
                href: laroute.route 'users.show', user: score.user.id
                score.user.username

            td className: (if score.max_combo == props.beatmap.max_combo?[0] then "#{bn}__perfect" else ''),
              "#{score.max_combo.toLocaleString()}x"

            for stat in props.hitTypeMapping
              td
                key: stat[0]
                className: (if score.statistics["count_#{stat[1]}"] == 0 then "#{bn}__zero" else ''),
                score.statistics["count_#{stat[1]}"].toLocaleString()

            td className: (if score.statistics.count_miss == 0 then "#{bn}__zero" else ''),
              score.statistics.count_miss.toLocaleString()

            td {}, _.round score.pp

            td className: "#{bn}__mods",
              el Mods, modifiers: ['scoreboard'], mods: score.mods

            td {},
              unless score.user.id == currentUser.id
                score.reportButton
