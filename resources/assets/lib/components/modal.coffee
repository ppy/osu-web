# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { createRef, PureComponent } from 'react'
import * as React from 'react'
import { div } from 'react-dom-factories'
import { createPortal } from 'react-dom'
import { blackoutToggle } from 'utils/blackout'

export class Modal extends PureComponent
  @isOpen: ->
    document.body.classList.contains 'js-react-modal---is-open'


  constructor: ->
    @ref = createRef()


  close: ->
    document.body.classList.remove 'js-react-modal---is-open'
    blackoutToggle(false, 0.5)


  componentDidMount: =>
    document.body.appendChild @portal
    document.addEventListener 'keydown', @handleEsc
    $(document).on 'turbolinks:before-cache.modal', () =>
      # componentWillUnmount runs too late depending on how the top level component was registered
      @close()
      document.body.removeChild @portal

    if @props.visible then @open() else @close()


  componentDidUpdate: (prevProps) =>
    return if prevProps.visible == @props.visible
    if @props.visible then @open() else @close()


  componentWillUnmount: =>
    @close()
    document.removeEventListener 'keydown', @handleEsc
    $(document).off '.modal'


  handleEsc: (e) =>
    @props.onClose?() if e.keyCode == 27


  handleMouseDown: (e) =>
    @clickStartTarget = e.target


  handleMouseUp: (e) =>
    @clickEndTarget = e.target


  # onclick's event does not include where a click started.
  # onclick's target is the outermost element that is involved in a click;
  # starting a click on the outer element and ending on an inner element will have the outer element as the event target,
  # likewise, starting on an inner element end ending on the outer element will still use the outer element as the event target.
  hideModal: (e) =>
    @props.onClose?() if e.button == 0 &&
                         e.target == @ref.current &&
                         @clickEndTarget == @clickStartTarget


  open: ->
    # TODO: move to global react state or something
    document.body.classList.add 'js-react-modal---is-open'
    blackoutToggle(true, 0.5)


  render: =>
    @portal ?= document.createElement('div')
    createPortal @renderPortalContent(), @portal


  renderPortalContent: =>
    div
      className: 'js-react-modal'
      onClick: @hideModal
      onMouseDown: @handleMouseDown
      onMouseUp: @handleMouseUp
      ref: @ref
      @props.children
