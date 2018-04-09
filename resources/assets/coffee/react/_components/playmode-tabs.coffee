###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{a, li, span, ul} = ReactDOMFactories

class @PlaymodeTabs extends React.Component
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
