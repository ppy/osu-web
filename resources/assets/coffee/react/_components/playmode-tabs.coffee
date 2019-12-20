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

import * as React from 'react'
import { a, div, li, span, ul } from 'react-dom-factories'

export class PlaymodeTabs extends React.Component
  render: =>
    div className: 'game-mode game-mode--beatmapsets',
      ul className: 'game-mode__items',
        for mode in BeatmapHelper.modes
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
