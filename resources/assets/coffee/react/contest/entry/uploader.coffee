###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, form, input, i} = React.DOM
el = React.createElement

class Contest.Entry.Uploader extends React.Component
  constructor: (props) ->
    super props
    @state =
      state: ''

  setOverlay: (state) ->
    return if @props.disabled
    @setState state: state

  componentDidMount: =>
    switch @props.contest.type
      when 'art'
        allowedExtensions = ['.jpg', '.jpeg', '.png']
        maxSize = 4000000

      when 'beatmap'
        allowedExtensions = ['.osu']
        maxSize = 1000000

      when 'music'
        allowedExtensions = ['.mp3']
        maxSize = 15000000


    $dropzone = $('.js-contest-entry-upload--dropzone')
    $uploadButton = $ '<input>',
      class: 'js-contest-entry-upload fileupload__input'
      type: 'file'
      name: 'entry'
      accept: allowedExtensions.join(',')
      disabled: @props.disabled

    $(@refs.uploadButtonContainer).append($uploadButton)

    $.subscribe 'dragenterGlobal.contest-upload', => @setOverlay('active')
    $.subscribe 'dragendGlobal.contest-upload', => @setOverlay('hidden')
    $(document).on 'dragenter.contest-upload', '.contest-user-entry--uploader', => @setOverlay('hover')
    $(document).on 'dragleave.contest-upload', '.contest-user-entry--uploader', => @setOverlay('active')

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

      fail: osu.fileuploadFailCallback($uploadButton)

  componentWillUnmount: =>
    $.unsubscribe '.contest-upload'
    $(document).off '.contest-upload'

    $('.js-contest-entry-upload')
      .fileupload 'destroy'
      .remove()

  render: =>
    labelClass = [
      'fileupload',
      'contest-user-entry',
      'contest-user-entry--uploader',
      'disabled' if @props.disabled,
      'contest-user-entry--dragndrop-active' if @state.state == 'active',
      'contest-user-entry--dragndrop-hover' if @state.state == 'hover',
    ]

    div className: "contest-user-entry contest-user-entry--new#{if @props.disabled then ' contest-user-entry--disabled' else ''}",
      div className: 'js-contest-entry-upload--dropzone',
        el 'label', className: labelClass.join(' '), ref: 'uploadButtonContainer',
          i className: 'fa fa-plus contest-user-entry__icon'
          div {}, osu.trans('contest.entry.drop_here')
