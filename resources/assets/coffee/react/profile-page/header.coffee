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

class CoverSelection extends React.Component
  onClick: =>
    return if @props.url == null

    $.ajax window.changeCoverUrl,
      method: 'put'
      data:
        cover_id: @props.name
      dataType: 'json'
    .done (userData) ->
      $(document).trigger 'user:update', userData.data


  onMouseEnter: =>
    return if @props.url == null
    $(document).trigger 'user:cover:set', @props.url


  onMouseLeave: ->
    $(document).trigger 'user:cover:reset'


  render: =>
    el 'div',
      className: 'profile-cover-selection'
      style:
        backgroundImage: "url('#{@props.thumbUrl}')"
      onClick: @onClick
      onMouseEnter: @onMouseEnter
      onMouseLeave: @onMouseLeave
      if @props.isSelected
        el 'i',
          className: 'fa fa-check-circle profile-cover-selection__selected-mark'


class CoverSelector extends React.Component
  render: =>
    el 'div', className: 'profile-change-cover-popup',
      el 'div', className: 'profile-change-cover-defaults',
        for i in [1..8]
          i = i.toString()
          el CoverSelection,
            key: i
            name: i
            isSelected: @props.cover.id == i
            url: "/images/headers/profile-covers/c#{i}.jpg"
            thumbUrl: "/images/headers/profile-covers/c#{i}t.jpg"
        el 'p', className: 'profile-cover-selections-info',
          Lang.get 'users.show.edit.cover.defaults_info'
      el CoverUploader, cover: @props.cover, canUpload: @props.canUpload


class CoverUploader extends React.Component
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
        $(document).trigger 'user:cover:upload:state', true
      done: (_e, data) ->
        $(document).trigger 'user:update', data.result.data
      fail: (_e, data) ->
        message = data.jqXHR?.responseJSON || Lang.get 'errors.unknown'
        osu.popup message, 'danger'
      complete: ->
        $(document).trigger 'user:cover:upload:state', false


  componentWillUnmount: =>
    $('.js-profile-cover-upload')
      .fileupload 'destroy'
      .remove()

  render: =>
    labelClass = 'btn-osu btn-osu--small btn-osu-default file-upload-label profile-cover-upload__button'
    labelClass += ' disabled' unless @props.canUpload

    el 'div', className: 'profile-cover-upload',
      el CoverSelection,
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


class HeaderInfo extends React.Component
  render: =>
    el 'div', className: 'user-bar',
      el 'div', null,
        el 'h1', className: 'profile-basic--large profile-basic',
          @props.user.username
        el 'p', className: 'profile-basic', @props.user.joinDate


class Rank extends React.Component
  render: =>
    return el('div') unless @props.rank.isRanked

    el 'div', className: 'user-bar user-rank',
      el 'div', null,
        el 'p', className: 'profile-basic profile-basic--large',
          el 'span', className: 'user-rank-icon',
            el 'i', className: "fa osu fa-#{@props.mode}-o"
          "##{@props.rank.global.toLocaleString()}"
        if @props.countryName != null
          el 'p', className: 'profile-basic',
            "#{@props.countryName} ##{@props.rank.country.toLocaleString()}"


class @ProfileHeader extends React.Component
  constructor: (props) ->
    super props
    @state =
      editing: false
      coverUrl: props.user.cover.url

    @coverSet = _.debounce @coverSet, 300


  componentDidMount: =>
    @_removeListeners()
    $(document).on 'user:cover:set.profilePageHeader', @coverSet
    $(document).on 'user:cover:reset.profilePageHeader', @coverReset


  componentWillReceiveProps: (newProps) =>
    @setState coerUrl: newProps.user.cover.url


  componentWillUnmount: =>
    @_removeListeners()


  _removeListeners: =>
    $(document).off '.profilePageHeader'


  toggleEdit: =>
    if @state.editing
      $('.blackout').css display: 'none'
      $('.profile-header').css zIndex: ''
      $(document).off 'click.profilePageHeader:toggleHeaderEdit'
    else
      $('.blackout').css display: 'block'
      $('.profile-header').css zIndex: 8001

      $(document).on 'click.profilePageHeader:toggleHeaderEdit', (e) =>
        return if $(e.target).closest('.profile-change-cover-popup').length
        return if $(e.target).closest('.profile-change-cover-button').length
        return if $('#overlay').is(':visible')
        @toggleEdit()

    @setState editing: !@state.editing


  coverReset: =>
    @coverSet null, @props.user.cover.url


  coverSet: (_e, url) =>
    return if @props.isCoverUpdating
    @setState coverUrl: url


  render: =>
    el 'div', className: 'row-page profile-header',
      el 'div',
        className: 'profile-cover',
        style:
          backgroundImage: "url('#{@state.coverUrl}')"

      el 'div', className: 'profile-avatar-container',
        el 'div',
          className: 'avatar avatar--profile'
          style:
            backgroundImage: "url('#{@props.user.avatarUrl}')"
          title: Lang.get('users.show.avatar', username: @props.user.username)

      el 'div',
        className: 'profile-cover-uploading-spinner'
        style:
          display: 'none' unless @props.isCoverUpdating

        el 'i', className: 'fa fa-circle-o-notch fa-spin'

      if @props.withEdit
        el 'div', className: 'profile-change-cover-button', onClick: @toggleEdit,
          Lang.get 'users.show.edit.cover.button'

      if @state.editing
        el CoverSelector, canUpload: @props.user.isSupporter, cover: @props.user.cover

      el 'div', className: 'user-bar-container',
        el HeaderInfo, user: @props.user
        el Rank,
          rank: @props.stats.rank
          countryName: @props.user.country.name
          mode: @props.mode
