# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import CoverSelection from 'profile-page/cover-selection'
import * as React from 'react'
import { a, div, label, p, strong } from 'react-dom-factories'
import StringWithComponent from 'string-with-component'
import { classWithModifiers } from 'utils/css'
el = React.createElement


export class CoverUploader extends React.Component
  constructor: (props) ->
    super props

    @uploadButtonContainer = React.createRef()


  destroy: =>
    @$uploadButton()
      .fileupload 'destroy'
      .remove()


  setup: =>
    $dropzone = $(@props.dropzoneRef.current)

    $uploadButton = $ '<input>',
      class: 'js-profile-cover-upload fileupload'
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

      fail: _exported.fileuploadFailCallback

      complete: ->
        $.publish 'user:cover:upload:state', false


  render: =>
    div className: 'profile-cover-uploader',
      el CoverSelection,
        url: @props.cover.custom_url
        thumbUrl: @props.cover.custom_url
        isSelected: !@props.cover.id?
        name: -1
        modifiers: ['custom']

      div className: 'profile-cover-uploader__button',
        label
          className: classWithModifiers('btn-osu-big', fileupload: true, full: true, rounded: true, disabled: !@props.canUpload)
          ref: @uploadButtonContainer
          osu.trans 'users.show.edit.cover.upload.button'

      div className: 'profile-cover-uploader__info',
        p className: 'profile-cover-uploader__info-entry',
          strong null,
            el StringWithComponent,
              mappings:
                link: a
                  href: laroute.route('store.products.show', product: 'supporter-tag')
                  target: '_blank'
                  osu.trans 'users.show.edit.cover.upload.restriction_info.link'
              pattern: osu.trans 'users.show.edit.cover.upload.restriction_info._'

        p className: 'profile-cover-uploader__info-entry',
          osu.trans 'users.show.edit.cover.upload.dropzone_info'

        p className: 'profile-cover-uploader__info-entry',
          osu.trans 'users.show.edit.cover.upload.size_info'


  $uploadButton: =>
    $(@uploadButtonContainer.current).find('.js-profile-cover-upload')
