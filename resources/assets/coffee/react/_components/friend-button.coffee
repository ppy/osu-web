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
{a,button,div,span} = React.DOM

bn = 'friend-button'

class @FriendButton extends React.Component
  constructor: (props) ->
    super props

    @state =
      hover: false
      friends: currentUser.friends

  hover: =>
    @setState
      hover: true

  unhover: =>
    @setState
      hover: false

  clicked: (e) =>
    e.preventDefault()

    friend = _.find @state.friends, (o) => o.target_id == @props.user.id
    if friend
      #unfriend
      $.ajax
        type: "DELETE"
        url: laroute.route('friends.destroy', friend: @props.user.id)
        success: (data) =>
          console.log(data)
          @setState
            friends: data.friends
    else
      #friend
      $.ajax
        type: "POST"
        url: laroute.route('friends.store', target: @props.user.id)
        success: (data) =>
          console.log(data)
          @setState
            friends: data.friends

  render: =>
    user = @props.user
    return span() if !user?

    friend = _.find @state.friends, (o) => o.target_id == user.id
    blockClass = "#{bn} btn-osu-lite btn-osu-lite--default"

    if friend and friend.mutual
      blockClass += ' btn-osu-lite--pink'

    button
      className: blockClass
      onMouseEnter: @hover
      onMouseLeave: @unhover
      onClick: @clicked
      if friend
        if @state.hover
          div {},
              el Icon, name: 'user-times', modifiers: ['fw']
              " #{osu.trans('friends.buttons.remove')}"
        else
          if friend.mutual
            div {},
              el Icon, name: 'heart', modifiers: ['fw']
              " #{osu.trans('friends.state.mutual')}"
          else
            div {},
              el Icon, name: 'user', modifiers: ['fw']
              " #{osu.trans('friends.state.friends')}"
      else
        div {},
          el Icon, name: 'user-plus', modifiers: ['fw']
          " #{osu.trans('friends.buttons.add')}"
