###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

import * as React from 'react'
import { div } from 'react-dom-factories'

export class RankChart extends React.Component
  constructor: (props) ->
    super props

    @id = "rank-chart-#{osu.uuid}"
    @rankChartArea = React.createRef()
    @state = {}


  componentDidMount: =>
    @rankChartUpdate()


  componentDidUpdate: =>
    @rankChartUpdate()


  componentWillUnmount: =>
    $(window).off ".#{@id}"
    $.unsubscribe ".#{@id}"


  formatX: (d) ->
    if d == 0
      osu.trans('common.time.now')
    else
      osu.transChoice('common.time.days_ago', -d)

  formatY: (d) ->
    "<strong>#{osu.trans('users.show.rank.global_simple')}</strong> ##{osu.formatNumber(-d)}"


  render: =>
    div
      className: 'u-full-size'
      ref: @rankChartArea


  rankChartUpdate: =>
    if !@rankChart?
      options =
        modifiers: ['profile-page']
        axisLabels: false
        circleLine: true
        scales:
          x: d3.scaleLinear()
          y: d3.scaleLog()
        margins:
          top: 15
          right: 15
          bottom: 15
          left: 15 # referenced in css .profile-detail__col--bottom-left
        infoBoxFormats:
          x: @formatX
          y: @formatY

      @rankChart = new LineChart(@rankChartArea.current, options)

      $(window).on "throttled-resize.#{@id}", @rankChart.resize

    data = @props.rankHistory?.data if @props.stats.is_ranked

    data = (data ? []).map (rank, i) ->
      x: i - data.length + 1
      y: -rank
    .filter (point) -> point.y < 0

    return unless data.length > 0

    if data.length == 1
      data.unshift
        x: data[0].x - 1
        y: data[0].y

    lastData = _.last(data)

    if lastData.x == 0
      lastData.y = -@props.stats.rank.global
    else
      data.push
        x: 0
        y: -@props.stats.rank.global

    @rankChart.loadData data
