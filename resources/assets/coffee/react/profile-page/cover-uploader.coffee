###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

{form, input} = ReactDOMFactories
el = React.createElement


class ProfilePage.CoverUploader extends React.Component
  componentDidMount: =>
    $dropzone = $('.js-profile-cover-upload--dropzone')

    $uploadButton = $ '<input>',
      class: 'js-profile-cover-upload fileupload__input'
      type: 'file'
      name: 'cover_file'
      disabled: !@props.canUpload

    @uploadButtonContainer.appendChild($uploadButton[0])

    $uploadButton.fileupload
      url: laroute.route('account.cover')
      dataType: 'json'
      dropZone: $dropzone

      submit: ->
        $.publish 'user:cover:upload:state', true
        $.publish 'dragendGlobal'

      done: (_e, data) ->
        $.publish 'user:update', data.result

      fail: osu.fileuploadFailCallback(@$uploadButton)

      complete: ->
        $.publish 'user:cover:upload:state', false


  componentWillUnmount: =>
    @$uploadButton()
      .fileupload 'destroy'
      .remove()

  render: =>
    labelClass = 'btn-osu btn-osu--small btn-osu-default fileupload profile-cover-uploader__button'
    labelClass += ' disabled' unless @props.canUpload

    el 'div', className: 'profile-cover-uploader',
      el ProfilePage.CoverSelection,
        url: @props.cover.custom_url
        thumbUrl: @props.cover.custom_url
        isSelected: !@props.cover.id?
        name: -1

      el 'label',
        className: labelClass
        ref: (el) => @uploadButtonContainer = el
        osu.trans 'users.show.edit.cover.upload.button'

      el 'div', className: 'profile-cover-uploader__info',
        el 'p', className: 'profile-cover-uploader__info-entry',
          el 'strong',
            dangerouslySetInnerHTML:
              __html: osu.trans 'users.show.edit.cover.upload.restriction_info'

        el 'p', className: 'profile-cover-uploader__info-entry',
          osu.trans 'users.show.edit.cover.upload.dropzone_info'

        el 'p', className: 'profile-cover-uploader__info-entry',
          osu.trans 'users.show.edit.cover.upload.size_info'


  $uploadButton: =>
    $(@uploadButtonContainer).find('.js-profile-cover-upload')
