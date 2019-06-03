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

import { createElement as el, createRef, PureComponent } from 'react'
import { createPortal } from 'react-dom'
import * as React from 'react'
import { a, button, div, i } from 'react-dom-factories'
import { TooltipContext } from 'tooltip-context'
import { Modal } from 'modal'

export class PopupMenu extends PureComponent
  @contextType = TooltipContext

  @defaultProps =
    children: (_dismiss) ->
      # empty function


  constructor: (props) ->
    super props

    @uuid = osu.uuid()
    @menu = createRef()

    @state =
      active: false


  componentDidMount: =>
    @tooltipHideEvent = @tooltipElement().qtip('option', 'hide.event')
    $(window).on 'throttled-resize.#{@uuid}', @resize
    $(document).on "turbolinks:before-cache.#{@uuid}", () =>
      @removePortal()


  resize: () =>
    return if !@state.active

    # disappear if the tree the menu is in is no longer displayed
    if !@menu.current.offsetParent?
      @portal.style.display = 'none'
      return

    $element = $(@menu.current)
    { top, left } = $element.offset()

    @portal.style.display = 'block'
    @portal.style.position = 'absolute'
    @portal.style.top = "#{Math.floor(top + $element.height() / 2)}px"
    @portal.style.left = "#{Math.floor(left + $element.width())}px"

    # keeps the menu showing above the tooltip;
    # portal should be after the tooltip in the document body.
    tooltipElement = @tooltipElement()[0]
    if tooltipElement?
      @portal.style.zIndex = getComputedStyle(tooltipElement).zIndex


  componentDidUpdate: (_prevProps, prevState) =>
    return if prevState.active == @state.active

    if @state.active
      @resize()
      @addPortal()
      @tooltipElement().qtip 'option', 'hide.event', false

      $(document).on "click.#{@uuid} keydown.#{@uuid}", @hide
      @props.onShow?()

    else
      @removePortal()
      @tooltipElement().qtip 'option', 'hide.event', @tooltipHideEvent

      $(document).off "click.#{@uuid} keydown.#{@uuid}", @hide
      @props.onHide?()


  componentWillUnmount: =>
    $(document).off ".#{@uuid}"


  dismiss: =>
    @setState active: false


  hide: (e) =>
    return if !@state.active || Modal.isOpen() || osu.popupShowing()

    event = e.originalEvent
    return if !event? # originalEvent gets eaten by error popup?

    if event.keyCode == 27 || (event.button == 0 && !@isMenuInPath(event.composedPath()))
      @setState active: false


  isMenuInPath: (path) =>
    @menu.current in path || @portal in path


  toggle: =>
    @setState active: !@state.active


  tooltipElement: =>
    $(@context).closest('.qtip')


  addPortal: =>
    document.body.appendChild @portal if !@portal.parentElement?


  removePortal: =>
    document.body.removeChild @portal if @portal.parentElement?


  render: =>
    @portal ?= document.createElement('div')

    div
      className: 'popup-menu'
      ref: @menu
      button
        className: 'popup-menu__button'
        type: 'button'
        onClick: @toggle
        i className: 'fas fa-ellipsis-v'

      createPortal @renderMenu(), @portal


  renderMenu: =>
    # using Fade.in causes rendering glitches from the stacking context due to will-change
    return null unless @state.active

    div
      className: "popup-menu__menu"
      div
        className: 'simple-menu simple-menu--popup-menu'
        @props.children @dismiss
