# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'

export Mod = ({modifiers = [], mod}) ->
    blockClass = 'mod'
    blockClass += " mod--#{m}" for m in modifiers
    blockClass += " mod--#{mod}"

    div
      className: blockClass
      title: osu.trans("beatmaps.mods.#{mod}")
