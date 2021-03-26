# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { ValueDisplay } from 'value-display'
import { div } from 'react-dom-factories'
el = React.createElement

formatNumber = (value) -> osu.formatNumber(Math.round(value))

export Pp = ({stats}) ->
  variantTooltip = []

  for variant in stats.variants ? []
    continue unless variant.pp?

    name = osu.trans("beatmaps.variant.#{variant.mode}.#{variant.variant}")
    value = formatNumber(variant.pp)

    variantTooltip.push("<div>#{name}: #{value}</div>")

  el ValueDisplay,
    modifiers: ['pp']
    label: 'pp'
    value:
      div
        title: ''
        "data-html-title": variantTooltip.join('')
        formatNumber(stats.pp)
