###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import { DetailBar } from './detail-bar'
import { MedalsCount } from './medals-count'
import { PlayTime } from './play-time'
import { Pp } from './pp'
import { Rank } from './rank'
import { RankChart } from './rank-chart'
import { RankCount } from './rank-count'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement
bn = 'profile-detail'

export class Detail extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      expanded: if currentUser.id? then currentUser.user_preferences.ranking_expanded else true


  render: =>
    div className: bn,
      div className: "#{bn}__bar",
        el DetailBar,
          stats: @props.stats
          toggleExtend: @toggleExtend
          expanded: @state.expanded
          user: @props.user
      div
        className: if @state.expanded then '' else 'hidden'
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
                rankHistory: @props.rankHistory
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


  toggleExtend: =>
    if currentUser.id?
      $.ajax laroute.route('account.options'),
        method: 'put',
        dataType: 'json',
        data:
          user_profile_customization:
            ranking_expanded:
              !@state.expanded

    @setState expanded: !@state.expanded
