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
import { a, button, span, i } from 'react-dom-factories'
import { Spinner } from 'spinner'
el = React.createElement

export BigButton = ({modifiers = [], text, icon, props = {}, extraClasses = [], isBusy = false}) ->
  props.className = osu.classWithModifiers('btn-osu-big', modifiers)
  props.className += " #{klass}" for klass in extraClasses

  blockElement =
    if props.href?
      if props.disabled
        span
      else
        a
    else
      button

  blockElement props,
    span className: "btn-osu-big__content #{if !text? || !icon? then 'btn-osu-big__content--center' else ''}",
      if text?
        span className: 'btn-osu-big__left',
          span className: 'btn-osu-big__text-top', text.top ? text
          if text.bottom?
            span className: 'btn-osu-big__text-bottom', text.bottom
      if icon?
        span className: 'btn-osu-big__icon',
          # ensure no random width change when changing icon
          span className: 'fa-fw',
            if isBusy
              el Spinner
            else
              i className: icon
