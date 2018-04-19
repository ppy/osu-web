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

{a, i, div} = ReactDOMFactories
el = React.createElement

bn = 'beatmap-discussions-user-filter'

allUsers =
  id: null,
  username: 'Everyone'


class BeatmapDiscussions.UserFilter extends React.PureComponent
  constructor: (props) ->
    super props

    @state =
      showingSelector: false

  render: =>
    classNames = "#{bn}"
    classNames += " #{bn}--selecting" if @state.showingSelector

    div
      className: classNames
      div
        className: "#{bn}__select"
        el BeatmapDiscussions.UserFilterItem,
          onUserSelected: @toggleSelector
          user: @selectedUser()

        div className: "#{bn}__decoration",
          i className: "fas fa-chevron-down"


      div
        className: "#{bn}__options"
        @listItem allUsers
        for own _, user of @props.users
          @listItem user


  listItem: (user) ->
    classNames = "#{bn}__item"
    classNames += " #{bn}__item--selected" if @selectedUser().id == user.id

    div
      key: user.id
      className: classNames
      el BeatmapDiscussions.UserFilterItem,
        onUserSelected: @userSelected
        user: user


  selectedUser: () =>
    @props.selectedUser ? allUsers


  userSelected: ({ user }) =>
    console.log user
    selectedUserId = user.id
    $.publish 'beatmapsetDiscussions:userFilterChanged', { selectedUserId }


  toggleSelector: () =>
    console.log 'toggle'
    @setState (prevState) ->
      Blackout.toggle(!prevState.showingSelector, 0.5)
      showingSelector: !prevState.showingSelector


