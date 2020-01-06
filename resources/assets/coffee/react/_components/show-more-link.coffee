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
import { a, button, span } from 'react-dom-factories'
import { Spinner } from 'spinner'
el = React.createElement
bn = 'show-more-link'

export ShowMoreLink = React.forwardRef (props, ref) =>
  return null unless props.hasMore || props.loading

  onClick = props.callback
  onClick ?= -> $.publish props.event, props.data
  icon = span className: "#{bn}__label-icon",
    span className: "fas fa-angle-#{props.direction ? 'down'}"

  if props.hideIcon
    icon = null

  element = button

  if props.url
    element = a

  element
    ref: ref
    type: 'button'
    onClick: onClick if !props.url
    href: props.url if props.url
    disabled: props.loading
    className: osu.classWithModifiers(bn, props.modifiers)
    span className: "#{bn}__spinner",
      el Spinner
    span className: "#{bn}__label",
      icon
      span className: "#{bn}__label-text",
        props.label ? osu.trans('common.buttons.show_more')

        if props.remaining?
          " (#{props.remaining})"
      icon
