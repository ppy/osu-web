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

{div, img} = ReactDOMFactories
el = React.createElement

class ProfilePage.Badges extends React.Component
  constructor: (props) ->
    super props

    @slideTimer = 5000
    @timeouts = {}
    @intervals = {}

    @state =
      currentBadge: @props.badges.length
      looping: true


  componentDidMount: =>
    @timeouts.first = Timeout.set 0, @nextBadge
    @intervals.slider = setInterval @nextBadge, @slideTimer


  componentWillUnmount: =>
    Timeout.clear timeout for _name, timeout of @timeouts
    clearInterval interval for _name, interval of @intervals


  render: =>
    if @props.badges.length == 0
      return div()
    else if @props.badges.length == 1
      badge = @props.badges[0]

      div className: 'profile-badges profile-badges--single',
        div className: 'profile-badges__stripe',
          div
            className: 'profile-badges__badge'
            style: backgroundImage: "url(#{badge.image_url})"
            title: badge.description
    else
      div
        className: 'profile-badges'
        onMouseEnter: @pause
        onMouseLeave: @resume
        div
          className: 'profile-badges__stripe'
          style:
            transform: @currentBadgeTransform()
            transitionDuration: if @state.looping then '' else '250ms'
          for badge in @props.badges
            div
              key: badge.image_url
              className: 'profile-badges__badge'
              style: backgroundImage: "url(#{badge.image_url})"
              title: badge.description
        div className: 'profile-badges__counter',
          osu.transChoice('common.count.badges', @props.badges.length)


  currentBadgeTransform: =>
    return "" if !@state.looping && !osu.isMobile()

    "translateX(#{-100 * @state.currentBadge / @props.badges.length}%)"


  nextBadge: (callback) =>
    return if !@state.looping

    @setState currentBadge: (@state.currentBadge + 1) % @props.badges.length, callback


  pause: =>
    @setState looping: false


  resume: =>
    @setState looping: true
