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

    $.subscribe 'dragenterGlobal.contest', => @setOverlay('active')
    $.subscribe 'dragendGlobal.contest', => @setOverlay('hidden')
    $(document).on 'dragenter.contest', '.contest__entry-uploader', => @setOverlay('hover')
    $(document).on 'dragleave.contest', '.contest__entry-uploader', => @setOverlay('active')

    $uploadButton.fileupload
      url: laroute.route 'contest-entry.submit', contest_id: @props.contest.id
      dataType: 'json'
      dropZone: $dropzone
      sequentialUploads: true

      add: (e, data) =>
        return if @props.disabled

        canUpload = true;
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
    $.unsubscribe '.contest'
    $('.js-contest-entry-upload')
      .fileupload 'destroy'
      .remove()

  render: =>
    labelClass = [
      'fileupload contest__entry-uploader',
      'disabled' if @props.disabled,
      'contest__user-entry--dragndrop-active' if @state.state == 'active',
      'contest__user-entry--dragndrop-hover' if @state.state == 'hover',
    ]

    div className: "contest__user-entry contest__user-entry--new #{if @props.disabled then 'contest__user-entry--disabled' else ''} js-react--entryUploader",
      div className: 'js-contest-entry-upload--dropzone',
        el 'label', className: labelClass.join(' '), ref: 'uploadButtonContainer',
          i className: 'fa fa-plus contest__entry-uploader-icon'
          div {}, osu.trans('contest.entry.drop_here')
