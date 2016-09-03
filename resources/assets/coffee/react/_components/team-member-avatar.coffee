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
{div, i} = React.DOM

bn = 'avatar'

class @TeamMemberAvatar extends React.Component
  constructor: (props) ->
    super props
    
    @state =
      hovering: false
  hoveron: =>
    @setState hovering: true
  hoveroff: =>
    @setState hovering: false
  click: =>
    if @props.callback? and @props.canRemove
      @props.callback()
  render: ->
    modifiers = @props
      .modifiers
      .map (m) -> "#{bn}--#{m}"
      .join ' '

    className = "#{bn} #{modifiers}"
    if @props.locked
      className += ' ui-state-disabled'
    if @props.user.id?
      div
        className: className
        id: @props.user.id
        onMouseEnter: @hoveron
        onMouseLeave: @hoveroff
        style:
          backgroundImage: "url('#{@props.user.avatarUrl}')"
        if @state.hovering and @props.canRemove
          i
            className: 'fa fa-remove'
            style:
              position: 'absolute'
              right: '0px'
            onClick: @click
    else
      div className: "#{className} #{bn}--guest"
