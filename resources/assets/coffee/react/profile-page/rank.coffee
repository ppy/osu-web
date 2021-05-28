# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { ValueDisplay } from 'value-display'
import { div } from 'react-dom-factories'
el = React.createElement


export Rank = ({type, stats, modifiers}) ->
  variantTooltip = []

  for variant in stats.variants ? []
    continue unless variant["#{type}_rank"]?

    name = osu.trans("beatmaps.variant.#{variant.mode}.#{variant.variant}")
    value = "##{osu.formatNumber(variant["#{type}_rank"])}"

    variantTooltip.push("<div>#{name}: #{value}</div>")

  el ValueDisplay,
    modifiers: modifiers
    label: osu.trans("users.show.rank.#{type}_simple")
    value:
      div
        title: ''
        "data-html-title": variantTooltip.join('')
        if stats["#{type}_rank"]?
          "##{osu.formatNumber(stats["#{type}_rank"])}"
        else
          '-'
