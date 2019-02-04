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

{a} = ReactDOMFactories
el = React.createElement

allUsers =
  id: null,
  text: osu.trans('beatmap_discussions.user_filter.everyone')

class BeatmapDiscussions.UserFilter extends React.PureComponent
  render: =>
    options = [allUsers]
    for own _id, user of @props.users
      options.push @mapUserProperties(user)

    selected = if @props.selectedUser?
                 @mapUserProperties(@props.selectedUser)
               else
                 id: null, text: osu.trans('beatmap_discussions.user_filter.label')

    el _exported.SelectOptions,
      bn: 'beatmap-discussions-user-filter'
      renderItem: @renderItem
      onItemSelected: @onItemSelected
      options: options
      selected: selected


  mapUserProperties: (user) ->
    id: user.id
    colour: user.profile_colour
    groups: user.groups
    text: user.username


  renderItem: ({ cssClasses, children, item, onClick }) =>
    a
      className: cssClasses
      href: BeatmapDiscussionHelper.url user: item?.id, true
      key: item?.id
      onClick: onClick
      children


  isOwner: (user) =>
    user? && user.id == @props.ownerId


  userGroup: (user) =>
    return unless user?

    if @isOwner(user)
      'owner'
    else
      BeatmapDiscussionHelper.moderationGroup(user)


  onItemSelected: (item) ->
    $.publish 'beatmapsetDiscussions:update', selectedUserId: item.id
