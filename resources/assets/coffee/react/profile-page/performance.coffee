###
# Copyright 2015 ppy Pty. Ltd.
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
{div, h2} = React.DOM
el = React.createElement

class ProfilePage.Performance extends React.Component
  componentDidMount: ->
    @_rankHistory()

  componentDidUpdate: ->
    @_rankHistory()

  componentWillUnmount: ->
    $(window).off '.profilePagePerformance'

  _yAxisTickValues: (data) ->
    return [] unless data.length

    rankRange = d3.extent data, (d) => d.y

    @_allTicks ||= [-1, -2.5, -5]

    while _.last(@_allTicks) >= rankRange[0]
      @_allTicks.push (10 * @_allTicks[@_allTicks.length - 3])

    ticks = [@_allTicks[0]]

    for tick in @_allTicks
      tick = Math.trunc(tick)
      if tick > rankRange[1]
        ticks[0] = tick
      else
        ticks.push tick
        break if tick < rankRange[0]

    ticks


  _rankHistory: ->
    data = (@props.rankHistories?.data || [])
      .filter (rank) => rank > 0

    data = data.map (rank, i) =>
      x: i - data.length + 1
      # rank must be drawn inverted.
      y: -rank

    unless @_rankHistoryChart
      tickValues =
        x: [-90, -60, -30, 0]

      domains =
        x: d3.extent(tickValues.x)

      formats =
        x: (d) =>
          if d == 0
            Lang.get('common.time.now')
          else
            Lang.choice('common.time.days_ago', -d)
        y: (d) => "##{(-d).toLocaleString()}"

      tooltipFormats =
        x: (d) =>
          date = moment().add(d, 'days').format 'MMM D'
          "#{formats.x(d)}<br>#{date}"

      scales =
        x: d3.scale.linear()
        y: d3.scale.log()

      options =
        formats: formats
        tooltipFormats: tooltipFormats
        scales: scales
        tickValues: tickValues
        domains: domains

      @_rankHistoryChart = new LineChart(@refs.chartArea, options)
      @_rankHistoryChart.margins.bottom = 65
      @_rankHistoryChart.xAxis.tickPadding 5

      $(window).on 'throttled-resize.profilePagePerformance', @_rankHistoryChart.resize

    yTickValues = @_yAxisTickValues data
    @_rankHistoryChart.options.tickValues.y = yTickValues
    @_rankHistoryChart.options.domains.y = d3.extent(yTickValues)
    @_rankHistoryChart.loadData(data)

  render: ->
    div className: 'profile-extra',
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      div ref: 'chartArea', className: 'chart'
