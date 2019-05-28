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
import * as React from 'react'
import { div, a } from 'react-dom-factories'
el = React.createElement
bn = 'beatmap-score-top'

export ScoreTop = (props) ->
  topClasses = (props.modifiers ? [])
    .map (m) -> "#{bn}--#{m}"
    .join ' '

  div className: "#{bn} #{topClasses}",
    div className: "#{bn}__section",
      div className: "#{bn}__wrapping-container #{bn}__wrapping-container--left",
        div className: "#{bn}__position",
          div className: "#{bn}__position-number", "##{props.position}"
          div className: "score-rank score-rank--tiny score-rank--#{props.score.rank}"

        div className: "#{bn}__avatar",
          a
            href: laroute.route 'users.show', user: props.score.user.id
            className: "avatar"
            style:
              backgroundImage: osu.urlPresence(props.score.user.avatar_url)

        div className: "#{bn}__user-box",
          a
            className: "#{bn}__username js-usercard"
            'data-user-id': props.score.user.id
            href: laroute.route 'users.show', user: props.score.user.id
            props.score.user.username

          div
            className: "#{bn}__achieved"
            dangerouslySetInnerHTML:
              __html: osu.trans('beatmapsets.show.scoreboard.achieved', when: osu.timeago(props.score.created_at))

          a
            href: laroute.route 'rankings',
              mode: props.playmode
              country: props.score.user.country_code
              type: 'performance'
            el FlagCountry,
              country: props.countries[props.score.user.country_code]
              modifiers: ['scoreboard', 'small-box']

      div className: "#{bn}__wrapping-container #{bn}__wrapping-container--right",
        div className: "#{bn}__stats",
          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--wider",
              osu.trans 'beatmapsets.show.scoreboard.headers.score_total'
            div className: "#{bn}__stat-value #{bn}__stat-value--score",
              osu.formatNumber(props.score.score)

        div className: "#{bn}__stats",
          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--wider",
              osu.trans 'beatmapsets.show.scoreboard.headers.accuracy'
            div className: "#{bn}__stat-value #{bn}__stat-value--score",
              "#{_.round props.score.accuracy * 100, 2}%"

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--wider",
              osu.trans 'beatmapsets.show.scoreboard.headers.combo'
            div className: "#{bn}__stat-value #{bn}__stat-value--score",
              "#{osu.formatNumber(props.score.max_combo)}x"

        div className: "#{bn}__stats #{bn}__stats--wrappable",
          for stat in props.hitTypeMapping
            div
              key: stat[0]
              className: "#{bn}__stat"
              div className: "#{bn}__stat-header",
                stat[0]
              div className: "#{bn}__stat-value #{bn}__stat-value--score #{bn}__stat-value--smaller",
                osu.formatNumber(props.score.statistics["count_#{stat[1]}"])

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header",
              osu.trans 'beatmapsets.show.scoreboard.headers.miss'
            div className: "#{bn}__stat-value #{bn}__stat-value--score #{bn}__stat-value--smaller",
              osu.formatNumber(props.score.statistics.count_miss)

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header",
              osu.trans 'beatmapsets.show.scoreboard.headers.pp'
            div className: "#{bn}__stat-value #{bn}__stat-value--score #{bn}__stat-value--smaller",
              _.round props.score.pp

          div className: "#{bn}__stat",
            div className: "#{bn}__stat-header #{bn}__stat-header--mods",
              osu.trans 'beatmapsets.show.scoreboard.headers.mods'
            div className: "#{bn}__stat-value #{bn}__stat-value--score #{bn}__stat-value--smaller",
              el Mods, modifiers: ['scoreboard'], mods: props.score.mods
