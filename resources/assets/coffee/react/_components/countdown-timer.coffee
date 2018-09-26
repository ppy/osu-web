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

{div} = ReactDOMFactories
el = React.createElement

bn = 'countdown-timer'

class @CountdownTimer extends React.Component
  constructor: (props) ->
    super props

    deadline = moment(@props.deadline)

    @state =
      deadline: deadline
      diff: Math.max(deadline.diff(), 0)

  componentDidMount: ->
    @timer = setInterval @updateTimer, 1000

  componentWillUnmount: ->
    clearInterval @timer

  updateTimer: =>
    diff = Math.max(@state.deadline.diff(), 0)

    clearInterval @timer if diff == 0

    @setState
      diff: diff

  render: =>
    diff = @state.diff / 1000

    fields =
      days: Math.floor(diff / (60 * 60 * 24))
      hours: Math.floor((diff / (60 * 60)) % 24)
      minutes: Math.floor((diff / 60) % 60)
      seconds: Math.floor(diff % 60)

    div className: bn,
      div className: "#{bn}__header", "#{osu.trans('common.time.remaining')}:"
      for field, value of fields
        div key: field, className: "#{bn}__field",
          div className: "#{bn}__digit",
            if value < 10 then "0#{value}" else value
          div className: "#{bn}__label", osu.trans("common.countdown.#{field}")

