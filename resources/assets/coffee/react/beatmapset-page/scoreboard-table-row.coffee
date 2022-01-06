# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import FlagCountry from 'flag-country'
import { round } from 'lodash'
import { route } from 'laroute'
import Mod from 'mod'
import { PlayDetailMenu } from 'play-detail-menu'
import * as React from 'react'
import { a, div, span, tr, td } from 'react-dom-factories'
import ScoreboardTime from 'scoreboard-time'
import PpValue from 'scores/pp-value'
import { classWithModifiers } from 'utils/css'
import { hasMenu, modeAttributesMap } from 'utils/score-helper'

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
      className: "#{classWithModifiers("#{bn}__body-row", classMods)}",

      el @tdLink,
        modifiers: ['rank']
        "##{index+1}"

      el @tdLink,
        modifiers: ['grade']
        div className: "score-rank score-rank--tiny score-rank--#{score.rank}"

      el @tdLink,
        modifiers: ['score']
        osu.formatNumber(score.score)

      el @tdLink,
        modifiers: ['perfect'] if score.accuracy == 1
        "#{osu.formatNumber(score.accuracy * 100, 2)}%"

      td className: cell,
        if score.user.country_code
          a
            className: "#{bn}__cell-content"
            href: laroute.route 'rankings',
              mode: @props.beatmap.mode
              country: score.user.country_code
              type: 'performance'
            el FlagCountry,
              country: score.user.country
              modifiers: ['flat']

      if score.user.is_deleted
        el @tdLink, null, osu.trans('users.deleted')
      else
        td className: "#{cell} u-relative",
          a
            className: "#{bn}__cell-content #{bn}__cell-content--user-link js-usercard"
            'data-user-id': score.user.id
            href: laroute.route 'users.show', user: score.user.id, mode: @props.beatmap.mode
            score.user.username

          a
            className: "#{bn}__cell-content"
            href: route('scores.show', mode: @props.score.mode, score: @props.score.best_id)

      el @tdLink,
        modifiers: ['perfect'] if score.max_combo == @props.beatmap.max_combo
        "#{osu.formatNumber(score.max_combo)}x"

      for stat in modeAttributesMap[@props.beatmap.mode]
        el @tdLink,
          key: stat.attribute
          modifiers: 'zero' if score.statistics[stat.attribute] == 0
          osu.formatNumber(score.statistics[stat.attribute])

      el @tdLink,
        modifiers: ['zero'] if score.statistics.count_miss == 0
        osu.formatNumber(score.statistics.count_miss)

      if @props.showPp
        el @tdLink,
          {}
          el PpValue, score: score

      el @tdLink,
        modifiers: ['time']
        el ScoreboardTime,
          dateTime: score.created_at

      el @tdLink,
        modifiers: ['mods']
        div className: "#{bn}__mods",
          el(Mod, mod: mod, key: mod) for mod in score.mods

      td className: "#{bn}__popup-menu",
        if hasMenu(score)
          el PlayDetailMenu,
            { score }


  tdLink: (props) =>
    td
      className: "#{bn}__cell"
      a
        className: classWithModifiers("#{bn}__cell-content", props.modifiers)
        href: props.href ? route('scores.show', mode: @props.score.mode, score: @props.score.best_id)
        props.children
