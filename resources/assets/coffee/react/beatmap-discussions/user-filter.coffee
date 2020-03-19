# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
