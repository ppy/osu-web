# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { PlayTime } from './play-time'
import { Pp } from './pp'
import { RankChart } from './rank-chart'
import MedalsCount from 'profile-page/medals-count'
import Rank from 'profile-page/rank'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement


export class DetailMobile extends React.PureComponent
  render: =>
    div className: 'profile-detail-mobile',
      if @props.stats.is_ranked
        div className: 'profile-detail-mobile__item profile-detail-mobile__item--rank-chart',
          el RankChart,
            rankHistory: @props.rankHistory
            stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el Rank, type: 'global', stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el Rank, type: 'country', stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el PlayTime, stats: @props.stats
      div className: 'profile-detail-mobile__item profile-detail-mobile__item--half',
        el MedalsCount, userAchievements: @props.userAchievements
      div className: 'profile-detail-mobile__item profile-detail-mobile__item--half',
        el Pp, stats: @props.stats
