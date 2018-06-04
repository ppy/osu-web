###
#    Copyright 2015-2017 ppy Pty. Ltd.
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
{button, div, i, span} = ReactDOMFactories

bn = 'user-action-button'

class @FriendButton extends React.PureComponent
  constructor: (props) ->
    super props

    @eventId = "friendButton-#{@props.user_id}-#{osu.uuid()}"
    @state =
      friend: _.find(currentUser.friends, (o) -> o.target_id == props.user_id)


  requestDone: =>
    @setState loading: false


  updateFriends: (data) =>
    @setState friend: _.find(data, (o) => o.target_id == @props.user_id), ->
      currentUser.friends = data
      $.publish 'user:update', currentUser
      $.publish "friendButton:refresh"


  clicked: (e) =>
    @setState loading: true

    if @state.friend
      #un-friending
      @xhr = $.ajax
        type: "DELETE"
        url: laroute.route 'friends.destroy', friend: @props.user_id
    else
      #friending
      @xhr = $.ajax
        type: "POST"
        url: laroute.route 'friends.store', target: @props.user_id

    @xhr
    .done @updateFriends
    .fail osu.emitAjaxError(@button)
    .always @requestDone


  refresh: (e) =>
    @setState
      friend: _.find(currentUser.friends, (o) => o.target_id == @props.user_id), =>
      @forceUpdate()


  componentDidMount: =>
    $.subscribe "friendButton:refresh.#{@eventId}", @refresh


  componentWillUnmount: =>
    $.unsubscribe ".#{@eventId}"
    @xhr?.abort()


  render: =>
    if @isVisible()
      @props.container?.classList.remove 'hidden'
    else
      @props.container?.classList.add 'hidden'

      return null

    blockClass = bn

    if @state.friend && !@state.loading
      if @state.friend.mutual
        blockClass += " #{bn}--mutual"
      else
        blockClass += " #{bn}--friend"

    button
      type: 'button'
      className: blockClass
      onClick: @clicked
      ref: (el) => @button = el
      title: if @state.friend then osu.trans('friends.buttons.remove') else osu.trans('friends.buttons.add')
      disabled: @state.loading
      if @state.loading
        el Spinner
      else
        if @state.friend
          [
            span
              key: 'hover'
              className: "#{bn}__icon #{bn}__icon--hover-visible"
              i className: 'fas fa-user-times'
            if @state.friend.mutual
              span
                key: 'normal-mutual'
                className: "#{bn}__icon #{bn}__icon--hover-hidden"
                i className: 'fas fa-user'
                i className: 'fas fa-user'
            else
              span
                key: 'normal'
                className: "#{bn}__icon #{bn}__icon--hover-hidden"
                i className: 'fas fa-user'
          ]
        else
          i className: 'fas fa-user-plus'


  isVisible: =>
    # - not a guest
    # - not viewing own card
    # - already a friend or can add more friends
    currentUser.id? &&
      _.isFinite(@props.user_id) &&
      @props.user_id != currentUser.id &&
      (@state.friend || currentUser.friends.length < currentUser.max_friends)
