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

import { MedalsCount } from './medals-count'
import { PlayTime } from './play-time'
import { Pp } from './pp'
import { Rank } from './rank'
import { RankChart } from './rank-chart'
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
