# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'
import { nextVal } from 'utils/seq'

export class RankChart extends React.Component
  constructor: (props) ->
    super props

    @id = "rank-chart-#{nextVal()}"
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
    div ref: @rankChartArea


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

      $(window).on "resize.#{@id}", @rankChart.resize

    data = @props.rankHistory?.data if @props.stats.is_ranked

    data = (data ? []).map (rank, i) ->
      x: i - data.length + 1
      y: -rank
    .filter (point) -> point.y < 0

    if data.length > 0
      if data.length == 1
        data.unshift
          x: data[0].x - 1
          y: data[0].y

      lastData = _.last(data)

      if lastData.x == 0
        lastData.y = -@props.stats.global_rank
      else
        data.push
          x: 0
          y: -@props.stats.global_rank

    @rankChart.loadData data
