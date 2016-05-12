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
{div} = React.DOM

bn = 'avatar'

@TeamMemberAvatar = React.createClass
  mixins: [React.addons.PureRenderMixin]


  render: ->
    modifiers = @props
      .modifiers
      .map (m) => "#{bn}--#{m}"
      .join ' '

    className = "#{bn} #{modifiers}"
    if @props.locked
      className += ' ui-state-disabled'
    if @props.user.id?
      div
        className: className
        style:
          backgroundImage: "url('#{@props.user.avatarUrl}')"
    else
      div className: "#{className} #{bn}--guest"
