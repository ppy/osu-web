# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement

bn = 'countdown-timer'

export class CountdownTimer extends React.Component
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
