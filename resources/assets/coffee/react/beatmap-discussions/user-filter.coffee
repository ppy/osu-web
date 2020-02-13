###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
#
#    This file is part of osu!web. osu!web is distributed with the hope of
#    attracting more community contributions to the core ecosystem of osu!.
#
#    osu!web is free software: you can redistribute it and/or modify
#    it under the terms of the Affero GNU General Public License version 3
#    as published by the Free Software Foundation.
#
#    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#    See the GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

import mapperGroup from 'beatmap-discussions/mapper-group'
import * as React from 'react'
import { a } from 'react-dom-factories'
import { SelectOptions } from 'select-options'
el = React.createElement

allUsers =
  id: null,
  text: osu.trans('beatmap_discussions.user_filter.everyone')

export class UserFilter extends React.PureComponent
  render: =>
    options = [allUsers]
    for own _id, user of @props.users
      options.push @mapUserProperties(user)

    selected = if @props.selectedUser?
                 @mapUserProperties(@props.selectedUser)
               else
                 id: null, text: osu.trans('beatmap_discussions.user_filter.label')

    el SelectOptions,
      bn: 'beatmap-discussions-user-filter'
      renderItem: @renderItem
      onItemSelected: @onItemSelected
      options: options
      selected: selected


  mapUserProperties: (user) ->
    group_badge: user.group_badge
    id: user.id
    text: user.username


  renderItem: ({ cssClasses, children, item, onClick }) =>
    userBadge = if @isOwner(item) then mapperGroup else item.group_badge
    style = osu.groupColour(userBadge)

    a
      className: cssClasses
      href: BeatmapDiscussionHelper.url user: item?.id, true
      key: item?.id
      onClick: onClick
      style: style
      children


  isOwner: (user) =>
    user? && user.id == @props.ownerId


  onItemSelected: (item) ->
    $.publish 'beatmapsetDiscussions:update', selectedUserId: item.id
