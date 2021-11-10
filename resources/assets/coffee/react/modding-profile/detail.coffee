# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { DetailBar } from './detail-bar'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement
bn = 'profile-detail'

export class Detail extends React.PureComponent
  render: =>
    div className: bn,
      el DetailBar,
        stats: @props.stats
        user: @props.user
