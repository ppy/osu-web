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

import { PlayDetail } from 'play-detail'
import { createElement as el, PureComponent } from 'react'
import * as React from 'react'
import { div } from 'react-dom-factories'
import { activeKeyDidChange, ContainerContext, KeyContext } from 'stateful-activation-context'

osu = window.osu

export class PlayDetailList extends PureComponent
  constructor: (props) ->
    super props

    @activeKeyDidChange = activeKeyDidChange.bind(@)

    @state = {}


  render: =>
    classMods = ['menu-active'] if @state.activeKey?

    el ContainerContext.Provider,
      value:
        activeKeyDidChange: @activeKeyDidChange

      div
        className: osu.classWithModifiers('play-detail-list', classMods)

        @props.scores.map (score, key) =>
          activated = @state.activeKey == key

          el KeyContext.Provider,
            key: key
            value: key
            el PlayDetail,
              { activated, score }
