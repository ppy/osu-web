###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div, span, a} = React.DOM
el = React.createElement

class MPHistory.Event extends React.Component
  icons:
    'PART': ['arrow-left', 'circle-o']
    'JOIN': ['arrow-right', 'circle-o']
    'KICK': ['arrow-left', 'ban']
    'CREATE': ['plus']
    'DISBAND': ['times']
    'HOST': ['exchange']

  render: ->
    console.log @props.event.text
    div className: 'mp-history-events__event mp-history-event',
      div className: 'mp-history-event__time-box',
        span className: 'mp-history-event__time',
          moment(@props.event.timestamp).format 'HH:mm:ss'
      div className: "mp-history-event__type mp-history-event__type--#{@props.event.text}",
        @icons[@props.event.text].map (m) ->
          el Icon, name: m, key: m
      div className: 'mp-history-event__info-box',
        a
          className: 'mp-history-event__text mp-history-event__text--username'
          href: laroute.route 'users.show', users: @props.event.user.data.id
          @props.event.user.data.username

        span className: 'mp-history-event__text',
          Lang.get "multiplayer.match.events.#{@props.event.text}"
