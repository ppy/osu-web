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

import { CoverSelection } from './cover-selection'
import * as React from 'react'
import { a, div, label, p, strong } from 'react-dom-factories'
import { StringWithComponent } from 'string-with-component'
el = React.createElement


export class CoverUploader extends React.Component
  constructor: (props) ->
    super props

    @uploadButtonContainer = React.createRef()


  componentDidMount: =>
    $dropzone = $('.js-profile-cover-upload--dropzone')

    $uploadButton = $ '<input>',
      class: 'js-profile-cover-upload fileupload__input'
      type: 'file'
      name: 'cover_file'
      disabled: !@props.canUpload

    @uploadButtonContainer.current.appendChild($uploadButton[0])

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

    div className: 'profile-cover-uploader',
      el CoverSelection,
        url: @props.cover.custom_url
        thumbUrl: @props.cover.custom_url
        isSelected: !@props.cover.id?
        name: -1
        modifiers: ['custom']

      label
        className: labelClass
        ref: @uploadButtonContainer
        osu.trans 'users.show.edit.cover.upload.button'

      div className: 'profile-cover-uploader__info',
        p className: 'profile-cover-uploader__info-entry',
          strong null,
            el StringWithComponent,
              mappings:
                ':link': a
                  href: laroute.route('store.products.show', product: 'supporter-tag')
                  key: 'link'
                  target: '_blank'
                  osu.trans 'users.show.edit.cover.upload.restriction_info.link'
              pattern: osu.trans 'users.show.edit.cover.upload.restriction_info._'

        p className: 'profile-cover-uploader__info-entry',
          osu.trans 'users.show.edit.cover.upload.dropzone_info'

        p className: 'profile-cover-uploader__info-entry',
          osu.trans 'users.show.edit.cover.upload.size_info'


  $uploadButton: =>
    $(@uploadButtonContainer.current).find('.js-profile-cover-upload')
