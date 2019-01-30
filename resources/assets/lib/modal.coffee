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

import { createRef, PureComponent } from 'react'
import { div } from 'react-dom-factories'
import { createPortal } from 'react-dom'

export class Modal extends PureComponent
  @isOpen: ->
    document.body.classList.contains 'js-react-modal---is-open'


  constructor: ->
    @ref = createRef()


  close: ->
    document.body.classList.remove 'js-react-modal---is-open'
    Blackout.toggle(false, 0.5)


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


  hideModal: (e) =>
    @props.onClose?() if e.button == 0 && e.target == @ref.current


  open: ->
    # TODO: move to global react state or something
    document.body.classList.add 'js-react-modal---is-open'
    Blackout.toggle(true, 0.5)


  render: =>
    @portal ?= document.createElement('div')
    createPortal @renderPortalContent(), @portal


  renderPortalContent: =>
    div
      className: 'js-react-modal'
      onClick: @hideModal
      ref: @ref
      @props.children
