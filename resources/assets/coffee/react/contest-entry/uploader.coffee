# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, form, input, label, span } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'
el = React.createElement

export class Uploader extends React.Component
  constructor: (props) ->
    super props

    @eventId = "contests-show-enter-uploader-#{osu.uuid()}"
    @dropzoneRef = React.createRef()
    @uploadContainerRef = React.createRef()

    @state =
      state: ''


  setOverlay: (state) ->
    return if @props.disabled

    @setState state: state


  componentDidMount: =>
    switch @props.contest.type
      when 'art'
        allowedExtensions = ['.jpg', '.jpeg', '.png']
        maxSize = 8*1024*1024

      when 'beatmap'
        allowedExtensions = ['.osu', '.osz']
        maxSize = 32*1024*1024

      when 'music'
        allowedExtensions = ['.mp3']
        maxSize = 16*1024*1024


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
      url: laroute.route 'contest-entries.store'
      dataType: 'json'
      dropZone: $dropzone
      sequentialUploads: true
      formData:
        contest_id: @props.contest.id

      add: (e, data) =>
        return if @props.disabled

        file = data.files[0]
        extension = /(\.[^.]+)$/.exec(file.name)[1]

        if !_.includes(allowedExtensions, extension)
          osu.popup osu.trans("contest.entry.wrong_type.#{@props.contest.type}"), 'danger'
          return

        if file.size > maxSize
          osu.popup osu.trans('contest.entry.too_big', limit: osu.formatBytes(maxSize, 0)), 'danger'
          return

        data.submit()

      submit: ->
        $.publish 'dragendGlobal'

      done: (_e, data) ->
        $.publish 'contest:entries:update', data: data.result

      fail: _exported.fileuploadFailCallback

  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"

    @$uploadButton()
      .fileupload 'destroy'
      .remove()

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
        span className: 'contest-userentry__icon',
          span className: 'fas fa-plus'
        div {}, osu.trans('contest.entry.drop_here')


  $uploadButton: =>
    $(@uploadContainerRef.current).find('.js-contest-entry-upload')
