# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, div, li, span, ul } from 'react-dom-factories'
import { modes } from 'utils/beatmap-helper'

export class PlaymodeTabs extends React.Component
  render: =>
    div className: 'game-mode game-mode--beatmapsets',
      ul className: 'game-mode__items',
        for mode in modes
          disabled = !(@props.enableAll || @props.beatmaps[mode]?)
          active = mode == @props.currentMode

          linkClass = 'game-mode-link'
          linkClass += ' game-mode-link--active' if active
          linkClass += ' game-mode-link--disabled' if disabled

          count = @count(mode)

          li
            className: 'game-mode__item'
            key: mode
            a
              className: linkClass
              onClick: @switchMode
              href: @props.hrefFunc?(mode) ? '#'
              'data-mode': mode
              'data-disabled': disabled
              osu.trans "beatmaps.mode.#{mode}"
              if count?
                span className: 'game-mode-link__badge', count


  count: (mode) =>
    if @props.counts?[mode]?
      return @props.counts[mode]

    if @props.showCounts
      count = Number(_.sumBy(@props.beatmaps[mode], (beatmap) -> !beatmap.convert))

      return count if count > 0


  switchMode: (e) =>
    e.preventDefault()
    target = e.currentTarget
    mode = target.dataset.mode

    return if @props.currentMode == mode || !mode?
    return if target.dataset.disabled == 'true'

    $.publish 'playmode:set', mode: mode
