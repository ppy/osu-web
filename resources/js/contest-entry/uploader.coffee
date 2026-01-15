# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { route } from 'laroute'
import * as React from 'react'
import { div, form, input, label, span } from 'react-dom-factories'
import { Spinner } from 'components/spinner'
import { fileuploadFailCallback } from 'utils/ajax'
import { classWithModifiers } from 'utils/css'
import { formatBytes } from 'utils/html'
import { trans } from 'utils/lang'
import { popup } from 'utils/popup'
import { nextVal } from 'utils/seq'

el = React.createElement

export class Uploader extends React.Component
  constructor: (props) ->
    super props

    @eventId = "contests-show-enter-uploader-#{nextVal()}"
    @dropzoneRef = React.createRef()
    @uploadContainerRef = React.createRef()

    @state =
      state: ''
      uploading: false


  setOverlay: (state) ->
    return if @props.disabled

    @setState state: state


  componentDidMount: =>
    allowedExtensions = @props.contest.allowed_extensions.map (ext) -> ".#{ext.toLowerCase()}"
    maxSize = @props.contest.max_filesize


    $dropzone = $(@dropzoneRef.current)
    $uploadButton = $ '<input>',
      class: 'js-contest-entry-upload fileupload'
      type: 'file'
      name: 'entry'
      accept: allowedExtensions.join(',')
      disabled: @props.disabled

    $(@uploadContainerRef.current).append($uploadButton)

    $.subscribe "dragenterGlobal.#{@eventId}", => @setOverlay('active')
    $.subscribe "dragendGlobal.#{@eventId}", => @setOverlay('hidden')

    $uploadButton.fileupload
      url: route 'contest-entries.store'
      dataType: 'json'
      dropZone: $dropzone
      sequentialUploads: true
      formData:
        contest_id: @props.contest.id

      add: (e, data) =>
        return if @props.disabled

        file = data.files[0]
        extension = /(\.[^.]+)$/.exec(file.name)[1]

        if !_.includes(allowedExtensions, extension.toLowerCase())
          popup trans('contest.entry.wrong_file_type', types: allowedExtensions.join(', ')), 'danger'
          return

        if file.size > maxSize
          popup trans('contest.entry.too_big', limit: formatBytes(maxSize, 0)), 'danger'
          return

        if @props.contest.type != 'art' || !@props.contest.forced_width && !@props.contest.forced_height
          data.submit()
          return

        @convertFileToImage(file).then (image) =>
          if image.width == @props.contest.forced_width && image.height == @props.contest.forced_height
            data.submit()
            return

          popup trans('contest.entry.wrong_dimensions',
            width: @props.contest.forced_width,
            height: @props.contest.forced_height), 'danger'

      submit: =>
        @setState uploading: true
        $.publish 'dragendGlobal'

      done: (_e, data) =>
        @setState uploading: false
        $.publish 'contest:entries:update', data: data.result

      fail: (e, data) =>
        @setState uploading: false
        fileuploadFailCallback(e, data)


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"

    @$uploadButton()
      .fileupload 'destroy'
      .remove()


  convertFileToImage: (file) =>
    new Promise (resolve, reject) ->
      image = new Image()
      reader = new FileReader()
      reader.onload = () -> image.src = reader.result
      reader.onerror = (error) -> reject(error)
      image.onload = () -> resolve(image)
      reader.readAsDataURL(file)


  render: =>
    div
      className: classWithModifiers 'contest-userentry',
        new: true
        disabled: @props.disabled
        'dragndrop-active': @state.state == 'active'
        'dragndrop-hover': @state.state == 'hover'
      ref: @dropzoneRef
      onDragEnter: => @setOverlay('hover')
      onDragLeave: => @setOverlay('active')
      label
        className: 'contest-userentry__uploader'
        ref: @uploadContainerRef
        if @state.uploading
          div className: 'contest-userentry__spinner',
            el Spinner
        else
          el React.Fragment, null,
            span className: 'contest-userentry__icon',
              span className: 'fas fa-plus'
            div {}, trans('contest.entry.drop_here')
            div
              className: 'contest-userentry__info'
              div {}, trans('contest.entry.allowed_extensions', types: @props.contest.allowed_extensions.map((ext) -> ".#{ext.toLowerCase()}").join(', '))
              if @props.contest.forced_width && @props.contest.forced_height
                div {}, trans('contest.entry.required_dimensions', width: @props.contest.forced_width, height: @props.contest.forced_height)
              div {}, trans('contest.entry.max_size', limit: formatBytes(@props.contest.max_filesize, 0))


  $uploadButton: =>
    $(@uploadContainerRef.current).find('.js-contest-entry-upload')
