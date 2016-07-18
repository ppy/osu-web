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

class TeamPage.ContentsTab extends React.Component
  onClick: (e) =>
    e.preventDefault()
    $.publish 'team:mode:set', @props.mode

  render: =>
    className = 'page-tabs__tab'
    className += ' page-tabs__tab--active' if @props.mode == @props.currentMode

    el 'a',
      href:  '#' + @props.mode
      onClick: @onClick
      className: className
      Lang.get "teams.mode.#{@props.mode}"
