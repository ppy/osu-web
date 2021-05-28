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
  mapUserProperties: (user) ->
    groups: user.groups
    id: user.id
    text: user.username


  handleChange: (option) =>
    $.publish 'beatmapsetDiscussions:update', selectedUserId: option.id


  isOwner: (user) =>
    user? && user.id == @props.ownerId


  render: =>
    options = for own _id, user of @props.users when user.id?
      @mapUserProperties(user)
    options.unshift(allUsers)

    selected = if @props.selectedUser?
                 @mapUserProperties(@props.selectedUser)
               else
                 id: null, text: osu.trans('beatmap_discussions.user_filter.label')

    el SelectOptions,
      bn: 'beatmap-discussions-user-filter'
      renderOption: @renderOption
      onChange: @handleChange
      options: options
      selected: selected


  renderOption: ({ cssClasses, children, onClick, option }) =>
    group = if @isOwner(option) then mapperGroup else option.groups?[0]
    style = osu.groupColour(group)

    a
      className: cssClasses
      href: BeatmapDiscussionHelper.url user: option?.id, true
      key: option?.id
      onClick: onClick
      style: style
      children
