# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { Mod } from 'mod'
import { img, div } from 'react-dom-factories'
el = React.createElement

export class ScoreboardMod extends React.Component
  onClick: =>
    $.publish 'beatmapset:scoreboard:set', enabledMod: @props.mod

  render: ->
    className = 'beatmapset-scoreboard__mod-box'
    className += ' beatmapset-scoreboard__mod-box--enabled' if @props.enabled

    div
      className: className
      onClick: @onClick
      div
        className: 'beatmapset-scoreboard__mod'
        el Mod, mod: @props.mod
