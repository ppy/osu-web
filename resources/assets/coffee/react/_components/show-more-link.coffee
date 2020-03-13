# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.
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
