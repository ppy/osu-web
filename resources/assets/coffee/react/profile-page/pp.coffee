# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { ValueDisplay } from 'value-display'
el = React.createElement


export Pp = ({stats}) ->
  el ValueDisplay,
    modifiers: ['pp']
    label: 'pp'
    value: osu.formatNumber(Math.round(stats.pp))
