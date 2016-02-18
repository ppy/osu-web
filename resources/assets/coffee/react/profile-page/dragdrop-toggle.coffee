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
{span} = React.DOM

class ProfilePage.DragDropToggle extends React.Component
  @contextTypes:
    withEdit: React.PropTypes.bool

  render: ->
    if @context.withEdit
      span
        className: 'fa fa-bars profile-extra__dragdrop-toggle'
    else
      # empty selector so react stops complaining that render() returns nothing
      span
        className: ''
