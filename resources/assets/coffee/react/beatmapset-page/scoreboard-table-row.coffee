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

import { FlagCountry } from 'flag-country'
import { Mods } from 'mods'
import { PlayDetailMenu } from 'play-detail-menu'
import * as React from 'react'
import { a, div, tr, td } from 'react-dom-factories'
import { ScoreHelper } from 'score-helper'
el = React.createElement
bn = 'beatmap-scoreboard-table'

export class ScoreboardTableRow extends React.PureComponent
  render: () =>
    { activated, index, score } = @props
    classMods = if activated then ['menu-active'] else ['highlightable']
    classMods.push 'first' if index == 0
    classMods.push 'friend' if @props.scoreboardType != 'friend' && osu.currentUserIsFriendsWith(score.user.id)
    classMods.push 'self' if score.user.id == currentUser.id

    cell = "#{bn}__cell"

    tr
      className: osu.classWithModifiers("#{bn}__body-row", classMods),

      td className: osu.classWithModifiers(cell, ['rank']), "##{index+1}"

      td className: osu.classWithModifiers(cell, ["grade"]),
        div className: "score-rank score-rank--tiny score-rank--#{score.rank}"

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

      td className: osu.classWithModifiers(cell, ['perfect'] if score.max_combo == @props.beatmap.max_combo),
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
        if ScoreHelper.hasMenu(score)
          el PlayDetailMenu,
            { score }
