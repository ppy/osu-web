# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import DetailBarButtons from 'profile-page/detail-bar-buttons'
import Rank from 'profile-page/rank'
import * as React from 'react'
import { a, button, div, i, span } from 'react-dom-factories'
import { jsonClone } from 'utils/json'
import { nextVal } from 'utils/seq'

el = React.createElement
bn = 'profile-detail-bar'

export class DetailBar extends React.PureComponent
  render: =>
    div className: bn,
      el DetailBarColumns, user: @props.user,
        div className: "#{bn}__entry",
            el Rank, type: 'global', stats: @props.stats

          div className: "#{bn}__entry",
            el Rank, type: 'country', stats: @props.stats

          div className: "#{bn}__entry #{bn}__entry--level",
            div
              className: "#{bn}__level"
              title: osu.trans('users.show.stats.level', level: @props.stats.level.current)
              @props.stats.level.current
