# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { span, i } from 'react-dom-factories'
el = React.createElement

elem = ({position, icon}) ->
  span
    key: position
    className: "icon-stack__icon icon-stack__icon--#{position}"
    i className: "fas fa-fw fa-#{icon}"

export IconExpand = ({expand = true, parentClass = ''}) ->
  span
    className: "icon-stack #{parentClass}"
    span className: 'icon-stack__base',
      i className: 'fas fa-fw fa-angle-down'
    if expand
      [
        elem position: 'top', icon: 'angle-up'
        elem position: 'bottom', icon: 'angle-down'
      ]
    else
      [
        elem position: 'top', icon: 'angle-down'
        elem position: 'bottom', icon: 'angle-up'
      ]
