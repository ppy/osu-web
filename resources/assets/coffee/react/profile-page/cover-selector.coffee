# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { CoverSelection } from './cover-selection'
import { CoverUploader } from './cover-uploader'
import * as React from 'react'
import { div, p } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
import { nextVal } from 'utils/seq'
el = React.createElement

export class CoverSelector extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "users-show-cover-selector-#{nextVal()}"
    @dropzoneRef = React.createRef()
    @uploaderRef = React.createRef()

    @state =
      dropOverlayState: 'inactive'
      dropOverlayVisibility: 'hidden'


  componentDidMount: =>
    @_removeListeners()
    @uploaderRef.current.setup()
    $.subscribe "dragenterGlobal.#{@eventId}", @_dropOverlayStart
    $.subscribe "dragendGlobal.#{@eventId}", @_dropOverlayEnd

  componentWillUnmount: =>
    @uploaderRef.current.destroy()
    @_removeListeners()

  _dropOverlayEnter: =>
    @setState dropOverlayState: 'hover'


  _dropOverlayLeave: =>
    @setState dropOverlayState: ''


  _dropOverlayStart: =>
    @setState dropOverlayVisibility: ''


  _dropOverlayEnd: =>
    @setState dropOverlayVisibility: 'hidden'


  _removeListeners: ->
    $.unsubscribe ".#{@eventId}"


  render: =>
    dropOverlayClass = 'profile-cover-change-popup__drop-overlay'

    div
      className: 'profile-cover-change-popup'
      ref: @dropzoneRef
      div className: 'profile-cover-change-popup__defaults',
        for i in [1..8]
          i = i.toString()
          div
            className: 'profile-cover-change-popup__selection'
            key: i
            el CoverSelection,
              name: i
              isSelected: @props.cover.id == i
              url: "/images/headers/profile-covers/c#{i}.jpg"
              thumbUrl: "/images/headers/profile-covers/c#{i}t.jpg"
        p className: 'profile-cover-change-popup__selections-info',
          osu.trans 'users.show.edit.cover.defaults_info'
      el CoverUploader,
        cover: @props.cover,
        canUpload: @props.canUpload
        dropzoneRef: @dropzoneRef
        ref: @uploaderRef
      if @props.canUpload
        div
          className: classWithModifiers('profile-cover-change-popup__drop-overlay', [@state.dropOverlayState])
          'data-visibility': @state.dropOverlayVisibility
          onDragEnter: @_dropOverlayEnter
          onDragLeave: @_dropOverlayLeave
          osu.trans 'users.show.edit.cover.upload.dropzone'
