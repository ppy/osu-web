###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { ValueDisplay } from 'value-display'
el = React.createElement


export Rank = ({type, stats, modifiers}) ->
  el ValueDisplay,
    modifiers: modifiers
    label: osu.trans("users.show.rank.#{type}_simple")
    value:
      if stats.rank[type]?
        "##{osu.formatNumber(stats.rank[type])}"
      else
        '-'
