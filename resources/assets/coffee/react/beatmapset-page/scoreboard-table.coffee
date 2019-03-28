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

{a, div, table, tr, td, th, thead, tbody} = ReactDOMFactories
el = React.createElement
bn = 'beatmap-scoreboard-table'

class BeatmapsetPage.ScoreboardTable extends React.PureComponent
  constructor: (props) ->
    super props

    @activeKeyDidChange = _exported.activeKeyDidChange.bind(@)

    @state = {}


  render: =>
    classMods = ['menu-active'] if @state.activeKey?

    el _exported.ContainerContext.Provider,
      value:
        activeKeyDidChange: @activeKeyDidChange

      div className: osu.classWithModifiers(bn, classMods),
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
              for stat in @props.hitTypeMapping
                th key: stat[0], className: "#{bn}__header #{bn}__header--hitstat", stat[0]
              th className: "#{bn}__header #{bn}__header--miss", osu.trans('beatmapsets.show.scoreboard.headers.miss')
              th className: "#{bn}__header #{bn}__header--pp", osu.trans('beatmapsets.show.scoreboard.headers.pp')
              th className: "#{bn}__header #{bn}__header--mods", osu.trans('beatmapsets.show.scoreboard.headers.mods')
              th className: "#{bn}__header #{bn}__header--popup-menu"

          tbody className: "#{bn}__body",
            @props.scores.map (score, key) =>
              activated = @state.activeKey == key

              el _exported.KeyContext.Provider,
                key: key
                value: key
                @renderRow key, { activated, score }


  renderRow: (index, { activated, score }) =>
    classMods = if activated then ['menu-active'] else ['highlightable']
    classMods.push 'first' if index == 0
    classMods.push 'friend' if @props.scoreboardType != 'friend' && osu.currentUserIsFriendsWith(score.user.id)
    classMods.push 'self' if score.user.id == currentUser.id

    cell = "#{bn}__cell"

    tr
      className: osu.classWithModifiers("#{bn}__body-row", classMods),
      key: index,

      td className: osu.classWithModifiers(cell, ['rank']), "##{index+1}"

      td className: osu.classWithModifiers(cell, ["grade"]),
        div className: "badge-rank badge-rank--tiny badge-rank--#{score.rank}"

      td className: osu.classWithModifiers(cell, ["score"]),
        osu.formatNumber(score.score)

      td className: osu.classWithModifiers(cell, ['perfect'] if score.accuracy == 1),
        "#{osu.formatNumber(score.accuracy * 100, 2)}%"

      td className: cell,
        if score.user.country_code
          a
            href: laroute.route 'rankings',
              mode: @props.beatmap.mode
              country: score.user.country_code
              type: 'performance'
            el FlagCountry,
              country: @props.countries[score.user.country_code]
              modifiers: ['scoreboard', 'small-box']

      td className: cell,
        a
          className: "#{bn}__user-link js-usercard"
          'data-user-id': score.user.id
          href: laroute.route 'users.show', user: score.user.id
          score.user.username

      td className: osu.classWithModifiers(cell, ['perfect'] if score.max_combo == @props.beatmap.max_combo?[0]),
        "#{osu.formatNumber(score.max_combo)}x"

      for stat in @props.hitTypeMapping
        td
          key: stat[0]
          className: osu.classWithModifiers(cell, ['zero'] if score.statistics["count_#{stat[1]}"] == 0),
          osu.formatNumber(score.statistics["count_#{stat[1]}"])

      td className: osu.classWithModifiers(cell, ['zero'] if score.statistics.count_miss == 0),
        osu.formatNumber(score.statistics.count_miss)

      td className: cell, _.round score.pp

      td className: osu.classWithModifiers(cell, ['mods']),
        el Mods, modifiers: ['scoreboard'], mods: score.mods

      td className: "#{bn}__popup-menu",
        if _exported.ScoreHelper.hasMenu(score)
          el _exported.PlayDetailMenu,
            { score }
