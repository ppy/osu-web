# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { createRef, PureComponent } from 'react'
import { createPortal } from 'react-dom'
import * as React from 'react'
import { button, div, i } from 'react-dom-factories'
import { TooltipContext } from 'tooltip-context'
import { Modal } from 'modal'
import { nextVal } from 'utils/seq'

export class PopupMenu extends PureComponent
  @contextType = TooltipContext

  @defaultProps =
    children: (_dismiss) ->
      # empty function


  constructor: (props) ->
    super props

    @eventId = "popup-menu-#{nextVal()}"
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
    $(window).off ".#{@uuid}"


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

    if @props.customRender
      @props.customRender createPortal(@props.children(@dismiss), @portal), @menu, @toggle
    else
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
    # using fadeIn causes rendering glitches from the stacking context due to will-change
    return null unless @state.active

    div
      className: "popup-menu__menu"
      div
        className: 'simple-menu simple-menu--popup-menu'
        @props.children @dismiss
