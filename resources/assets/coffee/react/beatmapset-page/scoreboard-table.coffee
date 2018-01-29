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

{a, div, table, tr, td, th, thead, tbody} = ReactDOMFactories
el = React.createElement
bn = 'beatmap-scoreboard-table'

BeatmapsetPage.ScoreboardTable = (props) ->
  # mapping of [displayed text, internal stat name] for each mode
  hitHeaders = switch props.beatmap.mode
    when 'osu'
      [['300', '300'], ['100', '100'], ['50', '50']]
    when 'taiko'
      [['great', '300'], ['good', '100']]
    when 'fruits'
      [['fruits', '300'], ['ticks', '100'], ['droplets', '50']]
    when 'mania'
      [['max', 'geki'], ['300', '300'], ['200', 'katu'], ['100', '100'], ['50', '50']]

  div className: "#{bn}",
    table
      className: "#{bn}__table"
      thead className: "#{bn}__header",
        tr {},
          th className: "#{bn}__header-rank", 'rank'
          th className: "#{bn}__header-grade", ''
          th className: "#{bn}__header-score", 'score'
          th className: "#{bn}__header-accuracy", 'accuracy'
          th className: "#{bn}__header-flag", ''
          th className: "#{bn}__header-player", 'player'
          th className: "#{bn}__header-maxcombo", 'max combo'
          for stat in hitHeaders
            th key: stat[0], className: "#{bn}__header-hitstat", stat[0]
          th className: "#{bn}__header-miss", 'miss'
          th className: "#{bn}__header-pp", 'pp'
          th className: "#{bn}__header-mods", 'mods'

      tbody className: "#{bn}__body",
        for score, i in props.scores
          tr
            className: (if i == 0 then "#{bn}--first" else '')
            key: i,

            td className: "#{bn}__rank", "##{i+1}"
            td className: "#{bn}__grade",
              div className: "badge-rank badge-rank--tiny badge-rank--#{score.rank}"
            td className: "#{bn}__score",
              score.score.toLocaleString()
            td className: (if score.accuracy == 1 then "#{bn}__perfect" else ''),
              "#{_.round(score.accuracy * 100, 2).toFixed(2)}%"
            td {},
              if score.user.country_code
                el FlagCountry,
                  country: props.countries[score.user.country_code]
                  classModifiers: ['scoreboard', 'small-box']
            td {},
              a
                href: laroute.route 'users.show', user: score.user.id
                score.user.username
            td className: (if score.max_combo == props.beatmap.maxCombo?[0] then "#{bn}__perfect" else ''),
              "#{score.max_combo.toLocaleString()}x"
            for stat in hitHeaders
              td
                key: stat[0]
                className: (if score.statistics["count_#{stat[1]}"] == 0 then "#{bn}__zero" else ''),
                score.statistics["count_#{stat[1]}"].toLocaleString()

            td className: (if score.statistics.count_miss == 0 then "#{bn}__zero" else ''),
              score.statistics.count_miss
            td {}, _.round score.pp
            td className: "#{bn}__mods",
              el Mods, modifiers: ['scoreboard'], mods: score.mods
