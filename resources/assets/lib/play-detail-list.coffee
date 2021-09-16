# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { PlayDetail } from 'play-detail'
import { createElement as el, PureComponent } from 'react'
import * as React from 'react'
import { div } from 'react-dom-factories'
import { activeKeyDidChange, ContainerContext, KeyContext } from 'stateful-activation-context'
import { classWithModifiers } from 'utils/css';

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
        className: classWithModifiers('play-detail-list', classMods)

        @props.scores.map (score, key) =>
          activated = @state.activeKey == key

          el KeyContext.Provider,
            key: key
            value: key
            el PlayDetail,
              { activated, score }
