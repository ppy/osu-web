###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

el = React.createElement

allUsers =
  id: null,
  text: osu.trans('beatmap_discussions.user_filter.everyone')


class BeatmapDiscussions.UserFilter extends React.PureComponent
  render: =>
    options = [allUsers]
    for own _id, user of @props.users
      options.push id: user.id, text: user.username

    selected = if @props.selectedUser?
                 id: @props.selectedUser.id, text: @props.selectedUser.username
               else
                 id: null, text: osu.trans('beatmap_discussions.user_filter.label')

    el SelectOptions,
      bn: 'beatmap-discussions-user-filter'
      onItemSelected: @onItemSelected
      options: options
      selected: selected


  onItemSelected: (item) ->
    $.publish 'beatmapsetDiscussions:update', selectedUserId: item.id
