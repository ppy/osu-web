# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'
bn = 'value-display'

export ValueDisplay = ({label, value, description, modifiers}) ->
  div
    className: osu.classWithModifiers(bn, modifiers)
    div className: "#{bn}__label", label
    div className: "#{bn}__value", value
    if description?
      div className: "#{bn}__description", description
