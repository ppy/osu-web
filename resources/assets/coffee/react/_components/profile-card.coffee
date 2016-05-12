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

{div, p, h3, i} = React.DOM

class @ProfileCard extends React.Component
  clicked: (ev) =>
    if @props.click
      @props.click @props.user #if clicked call function handed with prop
  render: =>
    div 
      className: 'profile-card' 
      onClick: @clicked
      style: 
        backgroundImage: "url('#{@props.user.cover.url}')", 
      div className: 'profile-card__upper',
        div 
          className: 'profile-card__avatar'
          style:
            backgroundImage: "url('#{@props.user.avatarUrl}')"
        div className: 'profile-card__userinfo',
          h3 className: 'profile-card__header',
            @props.user.username
          div className: 'profile-card__flags',
            el FlagCountry, country: @props.user.country
      div className: 'profile-card__status-container',
        i className: 'fa fa-circle-o profile-card__text', style: color: "#fff"
        div className: 'profile-card__text',
          "Online"
