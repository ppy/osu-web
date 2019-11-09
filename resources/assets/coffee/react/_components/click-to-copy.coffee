###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { span, i, a } from 'react-dom-factories'
el = React.createElement

bn = 'click-to-copy'

export class ClickToCopy extends React.PureComponent
  componentWillUnmount: =>
    @restoreTooltipText()


  restoreTooltipText: =>
    @api.set('content.text', @title) if @title
    Timeout.clear @timer
    @timer = null


  click: (e) =>
    e.preventDefault()
    el = e.currentTarget
    @api ?= $(el).qtip('api')

    # copy url to clipboard
    clipboard.writeText @props.value

    # change tooltip text to provide feedback
    @api.set 'content.text', osu.trans('common.buttons.click_to_copy_copied')

    # set timer to reset tooltip text
    Timeout.clear @timer
    @timer = Timeout.set 1000, @restoreTooltipText
    @title ?= el.getAttribute('title') || el.dataset.origTitle


  render: =>
    return span() if !@props.value

    a
      className: osu.classWithModifiers bn, @props.modifiers ? []
      'data-tooltip-pin-position': true
      'data-tooltip-position': 'bottom center'
      href: '#'
      onClick: @click
      title: osu.trans('common.buttons.click_to_copy')
      @props.label ? @props.value
      i
        className: "fas fa-paste #{bn}__icon"
