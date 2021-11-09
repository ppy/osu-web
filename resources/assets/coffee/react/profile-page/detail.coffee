# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { DetailBar } from './detail-bar'
import { PlayTime } from './play-time'
import { Pp } from './pp'
import { Rank } from './rank'
import { RankChart } from './rank-chart'
import { RankCount } from './rank-count'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import MedalsCount from 'profile-page/medals-count'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement
bn = 'profile-detail'

export class Detail extends React.Component
  render: =>
    el Observer, null, =>
      div className: bn,
        el DetailBar,
          stats: @props.stats
          user: @props.user
        div
          className: if core.userPreferences.get('ranking_expanded') then '' else 'hidden'
          div className: "#{bn}__row #{bn}__row--top",
            div className: "#{bn}__col #{bn}__col--top-left",
              div className: "#{bn}__top-left-item",
                el PlayTime, stats: @props.stats
              div className: "#{bn}__top-left-item",
                el MedalsCount, userAchievements: @props.userAchievements
              div className: "#{bn}__top-left-item",
                el Pp, stats: @props.stats

            div className: "#{bn}__col",
              el RankCount, stats: @props.stats
          div className: "#{bn}__row",
            div className: "#{bn}__col #{bn}__col--bottom-left",
              if @props.stats.is_ranked
                el RankChart,
                  rankHistory: @props.user.rank_history
                  stats: @props.stats
              else
                div className: "#{bn}__empty-chart",
                  osu.trans('users.show.extra.unranked')

            div className: "#{bn}__col #{bn}__col--bottom-right",
              div className: "#{bn}__bottom-right-item",
                el Rank,
                  modifiers: ['large']
                  type: 'global'
                  stats: @props.stats

              div className: "#{bn}__bottom-right-item",
                el Rank,
                  type: 'country'
                  stats: @props.stats
