###
#    Copyright 2015-2018 ppy Pty. Ltd.
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
  portals = document.getElementsByClassName('js-react-modal')

  constructor: ->
    @ref = createRef()


  componentDidMount: =>
    document.addEventListener 'keydown', @handleEsc


  componentDidUpdate: (prevProps) =>
    Blackout.toggle(@props.visible, 0.5) unless prevProps.visible == @props.visible


  componentWillUnmount: =>
    document.removeEventListener 'keydown', @handleEsc


  handleEsc: (e) =>
    @props.onClose?() if e.keyCode == 27


  hideModal: (e) =>
    @props.onClose?() if !e? || (e.button == 0 && e.target == @ref.current)


  render: =>
    createPortal @renderPortalContent(), portals[0]


  renderPortalContent: =>
    div
      className: @props.bn
      onClick: @hideModal
      ref: @ref
      @props.children
