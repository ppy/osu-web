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
    return unless @props.rankHistories

    data = @props.rankHistories.data
      .filter (rank) => rank > 0

    startDate = moment().startOf('day').subtract(data.length, 'days')

    data = data.map (rank) =>
      x: startDate.add(1, 'day').clone().toDate()
      # rank must be drawn inverted.
      y: -rank

    yAxisTickValues = @_yAxisTickValues data

    unless @_rankHistoryChart
      formats =
        x: d3.time.format '%b-%-d'
        y: (d) => "##{(-d).toLocaleString()}"

      scales =
        y: d3.scale.log()

      options =
        formats: formats
        scales: scales

      @_rankHistoryChart = new LineChart(@refs.chartArea, options)
      $(window).on 'throttled-resize.profilePagePerformance', @_rankHistoryChart.resize

    @_rankHistoryChart.options.domains = y: d3.extent(yAxisTickValues)
    @_rankHistoryChart.options.tickValues = y: yAxisTickValues
    @_rankHistoryChart.loadData(data)

  render: ->
    div className: 'profile-extra',
      el ProfilePage.DragDropToggle

      h2 className: 'profile-extra__title', Lang.get('users.show.extra.performance.title')
      
      div
        className: 'hidden' unless @props.rankHistories
        div ref: 'chartArea', className: 'chart'
