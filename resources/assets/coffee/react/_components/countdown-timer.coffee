###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{div} = React.DOM
el = React.createElement

bn = 'countdown-timer'

class @CountdownTimer extends React.Component
  constructor: (props) ->
    super props
    @state =
      deadline: @props.deadline
      diff: @diff(@props.deadline)

  componentDidMount: ->
    @timer = setInterval @updateTimer, 1000

  componentWillUnmount: ->
    clearInterval @timer

  diff: (time) ->
    diff = moment.utc(time).diff()
    if diff > 0 then diff else 0

  updateTimer: =>
    diff = @diff(@state.deadline)

    clearInterval @timer if diff == 0

    @setState
      diff: diff

  render: =>
    diff = @diff(@state.deadline) / 1000

    fields =
      'days': Math.floor(diff / (60 * 60 * 24))
      'hours': Math.floor((diff / (60 * 60)) % 24)
      'minutes': Math.floor((diff / 60) % 60)
      'seconds': Math.floor(diff % 60)

    divs = []
    _.each fields, (value, field) ->
      divs.push div key: field, className: "#{bn}__field",
        div className: "#{bn}__digit",
          if value < 10 then "0#{value}" else value
        div className: "#{bn}__label", field

    div className: bn,
      div className: "#{bn}__header", "#{osu.trans('common.time.remaining')}:"
      divs
