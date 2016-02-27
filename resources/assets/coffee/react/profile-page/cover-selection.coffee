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

class ProfilePage.CoverSelection extends React.Component
  onClick: =>
    return if @props.url == null

    $.ajax Url.updateProfileAccount,
      method: 'post'
      data:
        cover_id: @props.name
      dataType: 'json'
    .done (userData) ->
      $.publish 'user:update', userData.data
    .error osu.ajaxError


  onMouseEnter: =>
    return if @props.url == null
    $.publish 'user:cover:set', @props.url


  onMouseLeave: ->
    $.publish 'user:cover:reset'


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
