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


  componentDidMount: =>
    $(document).on 'click.userFilter', @hideSelector


  componentDidUpdate: (_prevProps, prevState) =>
    Blackout.toggle(@state.showingSelector, 0.5) unless prevState.showingSelector == @state.showingSelector


  componentWillUnmount: ->
    $(document).off '.userFilter'


  hideSelector: (e) =>
    return if e.button != 0
    return unless @state.showingSelector
    return if $(e.target).closest(".js-#{bn}").length

    @setState showingSelector: false


  render: =>
    classNames = "#{bn} js-#{bn}"
    classNames += " #{bn}--selecting" if @state.showingSelector

    div
      className: classNames
      div
        className: "#{bn}__select"
        @renderItem
          children: [
            div
              className: 'u-ellipsis-overflow'
              key: 'selector'
              @selectedUser().username,

            div
              key: 'decoration'
              className: "#{bn}__decoration",
              i className: "fas fa-chevron-down"
          ],
          onClick: @toggleSelector

      div
        className: "#{bn}__options"
        @renderOption allUsers
        for own _, user of @props.users
          @renderOption user


  renderOption: (user) ->
    @renderItem
      children: [
        div
          className: 'u-ellipsis-overflow'
          key: user.id
          user.username
      ],
      key: user.id
      selected: @selectedUser().id == user.id
      onClick: (event) => @userSelected(event, user)


  renderItem: ({ children, key, onClick, selected = false }) ->
    classNames = "#{bn}__item"
    classNames += " #{bn}__item--selected" if selected

    a
      children: children
      className: classNames
      href: '#'
      key: key
      onClick: onClick


  selectedUser: () =>
    @props.selectedUser ? allUsers


  toggleSelector: (event) =>
    return if event.button != 0
    event.preventDefault()

    @setState showingSelector: !@state.showingSelector


  userSelected: (event, user) ->
    return if event.button != 0
    event.preventDefault()

    selectedUserId = user.id
    $.publish 'beatmapsetDiscussions:userFilterChanged', { selectedUserId }
    @setState showingSelector: false
