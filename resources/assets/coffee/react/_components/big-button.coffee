# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { a, button, span, i } from 'react-dom-factories'
import { Spinner } from 'spinner'
import { classWithModifiers } from 'utils/css'

el = React.createElement

export BigButton = ({modifiers = [], text, icon, props = {}, extraClasses = [], isBusy = false}) ->
  props.className = classWithModifiers('btn-osu-big', modifiers)
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
