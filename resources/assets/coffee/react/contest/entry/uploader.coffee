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
    $dropzone = $('.js-contest-entry-upload--dropzone')
    $uploadButton = $ '<input>',
      class: 'js-contest-entry-upload fileupload__input'
      type: 'file'
      name: 'entry'
      accept: '.osu'
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

        file = data.files[0];
        if (!(/\.(osu)$/i).test(file.name))
          osu.popup osu.trans('contest.entry.wrong_type.beatmap'), 'danger'
          return

        if (file.size > 1000000)
          osu.popup osu.trans('contest.entry.too_big'), 'danger'
          return

        data.submit();

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
