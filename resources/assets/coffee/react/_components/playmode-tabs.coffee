###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { a, li, span, ul } from 'react-dom-factories'

export class PlaymodeTabs extends React.Component
  render: =>
    ul className: 'page-mode',
      for mode in BeatmapHelper.modes
        disabled = !(@props.enableAll || @props.beatmaps[mode]?)
        active = mode == @props.currentMode

        linkClass = 'page-mode-link'
        linkClass += ' page-mode-link--is-active' if active
        linkClass += ' page-mode-link--is-disabled' if disabled

        li
          className: 'page-mode__item'
          key: mode
          a
            className: linkClass
            onClick: @switchMode
            href: @props.hrefFunc?(mode) ? '#'
            'data-mode': mode
            'data-disabled': disabled
            osu.trans "beatmaps.mode.#{mode}"
            if @props.counts?[mode]?
              span className: 'page-mode-link__badge', @props.counts[mode]
            if @props.showCounts
              count = Number(_.sumBy(@props.beatmaps[mode], (beatmap) -> !beatmap.convert))
              span className: 'page-mode-link__badge', count if count > 0
            span className: 'page-mode-link__stripe'


  switchMode: (e) =>
    e.preventDefault()
    target = e.currentTarget
    mode = target.dataset.mode

    return if @props.currentMode == mode || !mode?
    return if target.dataset.disabled == 'true'

    $.publish 'playmode:set', mode: mode
