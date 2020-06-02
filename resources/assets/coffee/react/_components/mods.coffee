# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import Mod from 'mod'
import { div, img } from 'react-dom-factories'
el = React.createElement

export Mods = ({modifiers = [], mods = []}) ->
    blockClass = 'mods'
    blockClass += " mods--#{mod}" for mod in modifiers

    div className: blockClass,
      for mod in mods
        div
          key: mod
          className: 'mods__mod'
          div
            className: 'mods__mod-image'
            el Mod, mod: mod
