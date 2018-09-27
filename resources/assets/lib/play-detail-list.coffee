###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

import { PlayDetail } from 'play-detail'
import { createElement as el, PureComponent } from 'react'
import { div } from 'react-dom-factories'

osu = window.osu

export class PlayDetailList extends PureComponent
  constructor: (props) ->
    super props

    @state = {}


  onMenuActive: ({ index, active }) =>
    activeMenu = index if active
    @setState { activeMenu }


  render: =>
    classMods = ['menu-active'] if @state.activeMenu?

    div
      className: osu.classWithModifiers('play-detail-list', classMods)
      @props.scores.map (score, i) =>
        el PlayDetail,
          activated: @state.activeMenu == i
          index: i
          key: i
          onMenuActive: @onMenuActive
          score: score

