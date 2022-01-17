# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { createRef, PureComponent } from 'react'
import { createPortal } from 'react-dom'
import * as React from 'react'
import { button, div, i } from 'react-dom-factories'
import { TooltipContext } from 'tooltip-context'
import { isModalShowing } from 'modal-helper'
import { nextVal } from 'utils/seq'

el = React.createElement

export class PopupMenu extends PureComponent
  @contextType = TooltipContext

  @defaultProps =
    children: (_dismiss) ->
      # empty function
    direction: 'left'


  constructor: (props) ->
    super props

    @eventId = "popup-menu-#{nextVal()}"
    @button = createRef()
    @menu = createRef()

    @state =
      active: false


  componentDidMount: =>
    @tooltipHideEvent = @tooltipElement().qtip('option', 'hide.event')
    $(window).on "resize.#{@eventId}", @resize
    $(document).on "turbolinks:before-cache.#{@eventId}", @removePortal


  resize: () =>
    return if !@state.active

    # disappear if the tree the menu is in is no longer displayed
    if !@button.current.offsetParent?
      @portal.style.display = 'none'
      return

    buttonRect = @button.current.getBoundingClientRect()
    menuRect = @menu.current.getBoundingClientRect()
    { scrollX, scrollY } = window

    left = scrollX + buttonRect.right
    # shift the menu right if it clips out of the window;
    # menuRect.x doesn't update until after layout is finished so the known position of buttonRect is used instead.
    if @props.direction == 'right' || buttonRect.x - menuRect.width < 0
      left += menuRect.width - buttonRect.width

    @portal.style.display = 'block'
    @portal.style.position = 'absolute'
    @portal.style.top = "#{Math.floor(scrollY + buttonRect.bottom + 5)}px"
    @portal.style.left = "#{Math.floor(left)}px"

    # keeps the menu showing above the tooltip;
    # portal should be after the tooltip in the document body.
    tooltipElement = @tooltipElement()[0]
    if tooltipElement?
      @portal.style.zIndex = getComputedStyle(tooltipElement).zIndex


  componentDidUpdate: (_prevProps, prevState) =>
    return if prevState.active == @state.active

    if @state.active
      @addPortal()
      @resize()
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
    $(window).off ".#{@uuid}"


  dismiss: =>
    @setState active: false


  hide: (e) =>
    return if !@state.active || isModalShowing()

    event = e.originalEvent
    return if !event? # originalEvent gets eaten by error popup?

    if event.keyCode == 27 || (event.button == 0 && !@isMenuInPath(event.composedPath()))
      @setState active: false


  isMenuInPath: (path) =>
    @button.current in path || @portal in path


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

    if @props.customRender
      @props.customRender createPortal(@renderMenu(), @portal), @button, @toggle
    else
      el React.Fragment, null,
        button
          className: 'popup-menu'
          ref: @button
          type: 'button'
          onClick: @toggle
          i className: 'fas fa-ellipsis-v'

        createPortal @renderMenu(), @portal


  renderMenu: =>
    # using fadeIn causes rendering glitches from the stacking context due to will-change
    return null unless @state.active

    div
      className: "popup-menu-float"
      ref: @menu
      @props.children @dismiss
