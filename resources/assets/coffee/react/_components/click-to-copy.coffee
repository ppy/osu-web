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

el = React.createElement
{span, i, a} = ReactDOMFactories

bn = 'click-to-copy'

class @ClickToCopy extends React.PureComponent
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
