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
{div, p, span} = React.DOM
el = React.createElement

class BeatmapSetPage.SuccessRate extends React.Component
  componentDidMount: ->
    @_renderChart()

  componentDidUpdate: ->
    @_renderChart()

  componentWillUnmount: ->
    $(window).off '.beatmapSetPageSuccessRate'

  _renderChart: ->
    data = @props.failtimes.map (m) -> m.data

    max = Math.max d3.max(data[0]), d3.max(data[1])

    unless @_successRateChart
      scales =
        x: d3.scale.linear()
        y: d3.scale.linear()

      options =
        domain: [0, max]
        scales: scales
        className: 'beatmapset-success-rate'

      @_successRateChart = new BarChart @refs.chartArea, options

      $(window).on 'throttled-resize.beatmapSetPageSuccessRate', @_successRateChart.resize

    @_successRateChart.loadData data

  legend = ['retry', 'fail']

  render: ->
    percentage = (@props.diff.passcount / @props.diff.playcount) * 100

    div
      className: 'page-extra'
      el BeatmapSetPage.ExtraHeader, name: 'success-rate'

      div className: 'beatmapset-success-rate',
        p
          className: 'beatmapset-success-rate__label'
          Lang.get 'beatmaps.beatmapset.show.extra.success-rate.points',
            percentage: percentage.toFixed 1
            failed: @props.diff.passcount
            all: @props.diff.playcount


        div className: 'beatmapset-success-rate__legend',
          legend.map (m) ->
            div className: 'beatmapset-success-rate__legend-item', key: m,
              span className: 'beatmapset-success-rate__legend-label', Lang.get "beatmaps.beatmapset.show.extra.success-rate.#{m}"
              div className: "beatmapset-success-rate__legend-color beatmapset-success-rate__legend-color--#{m}"

        div
          className: 'beatmapset-success-rate__chart'
          ref: 'chartArea'
