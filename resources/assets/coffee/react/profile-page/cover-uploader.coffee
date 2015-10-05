###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement


class ProfilePage.CoverUploader extends React.Component
  componentDidMount: =>
    $uploadButton = $ '<input>',
      class: 'js-profile-cover-upload file-upload-input'
      type: 'file'
      name: 'cover_file'
      'data-url': window.changeCoverUrl
      disabled: !@props.canUpload

    $(React.findDOMNode @refs.uploadButtonContainer).append($uploadButton)

    $uploadButton.fileupload
      method: 'PUT'
      dataType: 'json'
      dropZone: $uploadButton
      submit: ->
        osu.showLoadingOverlay()
        $.publish 'user:cover:upload:state', true
      done: (_e, data) ->
        $.publish 'user:update', data.result.data
      fail: (_e, data) ->
        message = data.jqXHR?.responseJSON || Lang.get 'errors.unknown'
        osu.popup message, 'danger'
      complete: ->
        osu.hideLoadingOverlay()
        $.publish 'user:cover:upload:state', false


  componentWillUnmount: =>
    $('.js-profile-cover-upload')
      .fileupload 'destroy'
      .remove()

  render: =>
    labelClass = 'btn-osu btn-osu--small btn-osu-default file-upload-label profile-cover-upload__button'
    labelClass += ' disabled' unless @props.canUpload

    el 'div', className: 'profile-cover-upload',
      el ProfilePage.CoverSelection,
        url: @props.cover.customUrl
        thumbUrl: @props.cover.customUrl
        isSelected: @props.cover.id == null

      el 'label', className: labelClass, ref: 'uploadButtonContainer',
        Lang.get 'users.show.edit.cover.upload.button'

      el 'div', className: 'profile-cover-upload-info',
        el 'p', className: 'profile-cover-upload-info-entry',
          el 'strong',
            dangerouslySetInnerHTML:
              __html: Lang.get 'users.show.edit.cover.upload.restriction_info'

        el 'p', className: 'profile-cover-upload-info-entry',
          Lang.get 'users.show.edit.cover.upload.size_info'
