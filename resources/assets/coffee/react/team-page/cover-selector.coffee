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
el = React.createElement

class TeamPage.CoverSelector extends React.Component
  constructor: (props) ->
    super props

    @state =
      dropOverlayState: 'inactive'
      dropOverlayVisibility: 'hidden'


  componentDidMount: =>
    @_removeListeners()
    $.subscribe 'dragenterGlobal.profilePageCoverSelector', @_dropOverlayStart
    $.subscribe 'dragendGlobal.profilePageCoverSelector', @_dropOverlayEnd

  componentWillUnmount: =>
    @_removeListeners()

  _dropOverlayEnter: =>
    @setState dropOverlayState: 'hover'


  _dropOverlayLeave: =>
    @setState dropOverlayState: ''


  _dropOverlayStart: =>
    @setState dropOverlayVisibility: ''


  _dropOverlayEnd: =>
    @setState dropOverlayVisibility: 'hidden'


  _removeListeners: ->
    $.unsubscribe '.profilePageCoverSelector'


  render: =>
    dropOverlayClass = 'profile-cover-change-popup__drop-overlay'

    el 'div', className: 'profile-cover-change-popup js-profile-cover-upload--dropzone',
      el 'div', className: 'profile-cover-change-popup__defaults',
        for i in [1..8]
          i = i.toString()
          el TeamPage.CoverSelection,
            key: i
            name: i
            isSelected: @props.cover.id == i
            url: "/images/headers/profile-covers/c#{i}.jpg"
            thumbUrl: "/images/headers/profile-covers/c#{i}t.jpg"
            id: @props.team.id
        el 'p', className: 'profile-cover-change-popup__selections-info',
          Lang.get 'users.show.edit.cover.defaults_info'
      el TeamPage.CoverUploader, cover: @props.cover, canUpload: true, id: @props.team.id
      if @props.canUpload
        el 'div',
          className: "#{dropOverlayClass} #{dropOverlayClass}--#{@state.dropOverlayState}"
          'data-visibility': @state.dropOverlayVisibility
          onDragEnter: @_dropOverlayEnter
          onDragLeave: @_dropOverlayLeave
          ref: 'dropOverlay'
          Lang.get 'users.show.edit.cover.upload.dropzone'
