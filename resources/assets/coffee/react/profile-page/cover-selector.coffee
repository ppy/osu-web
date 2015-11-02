###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, version 3 of the License.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
el = React.createElement

class ProfilePage.CoverSelector extends React.Component
  constructor: (props) ->
    super props

    @state =
      dropOverlayState: 'inactive'


  componentDidMount: =>
    @_removeListeners()
    $.subscribe 'dragenterGlobal.profilePageCoverSelector', @_dropOverlayStart
    $.subscribe 'dragendGlobal.profilePageCoverSelector', @_dropOverlayEnd

  componentWillUnmount: =>
    @_removeListeners()

  _dropOverlayEnter: =>
    @setState dropOverlayState: 'hover'


  _dropOverlayLeave: =>
    @setState dropOverlayState: 'active'


  _dropOverlayStart: =>
    if @state.dropOverlayState == 'inactive'
      # Animating inactive => active doesn't work, must go through hidden first.
      @setState dropOverlayState: 'hidden'

      # To let state update to propagate properly first.
      setTimeout @_dropOverlayStart, 0

    else if @state.dropOverlayState == 'hidden'
      @setState dropOverlayState: 'active'


  _dropOverlayEnd: =>
    # Transition to hidden first because css can't animate `display: none`.
    # The same as _dropOverlayStart.
    @setState dropOverlayState: 'hidden'

    deactivate = =>
      return if @state.dropOverlayState != 'hidden'
      @setState dropOverlayState: 'inactive'

    # Matches animation duration in css which is 120ms
    setTimeout deactivate, 120


  _removeListeners: ->
    $.unsubscribe '.profilePageCoverSelector'


  render: =>
    dropOverlayClass = 'profile-change-cover-popup__drop-overlay'

    el 'div', className: 'profile-change-cover-popup js-profile-cover-upload--dropzone',
      el 'div', className: 'profile-change-cover-defaults',
        for i in [1..8]
          i = i.toString()
          el ProfilePage.CoverSelection,
            key: i
            name: i
            isSelected: @props.cover.id == i
            url: "/images/headers/profile-covers/c#{i}.jpg"
            thumbUrl: "/images/headers/profile-covers/c#{i}t.jpg"
        el 'p', className: 'profile-cover-selections-info',
          Lang.get 'users.show.edit.cover.defaults_info'
      el ProfilePage.CoverUploader, cover: @props.cover, canUpload: @props.canUpload
      if @props.canUpload
        el 'div',
          className: "#{dropOverlayClass} #{dropOverlayClass}--#{@state.dropOverlayState}"
          onDragEnter: @_dropOverlayEnter
          onDragLeave: @_dropOverlayLeave
          ref: 'dropOverlay'
          Lang.get 'users.show.edit.cover.upload.dropzone'
