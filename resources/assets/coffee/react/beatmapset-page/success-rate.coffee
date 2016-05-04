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

legend = ['retry', 'fail']

class BeatmapsetPage.SuccessRate extends React.Component
  componentDidMount: ->
    @_renderChart()

  componentDidUpdate: ->
    @_renderChart()

  componentWillUnmount: ->
    $(window).off '.beatmapSetPageSuccessRate'

  _renderChart: ->
    return unless @props.failtimes.length > 0

    failtimes = _.map @props.failtimes, (m) -> m.data
    data = _.zip failtimes[0], failtimes[1]

    max = d3.max _.map data, (m) -> m[0] + m[1]

    unless @_successRateChart
      scales =
        x: d3.scale.linear()
        y: d3.scale.linear()

      options =
        domain: [0, max]
        scales: scales
        className: 'beatmapset-success-rate'

      @_successRateChart = new BarChart @refs.chart, options

      $(window).on 'throttled-resize.beatmapSetPageSuccessRate', @_successRateChart.resize

    @_successRateChart.loadData data

  render: ->
    percentage = _.round ((@props.beatmap.playcount - @props.beatmap.passcount) / @props.beatmap.playcount) * 100

    div
      className: 'page-extra'
      el BeatmapsetPage.ExtraHeader, name: 'success-rate'

      p className: 'beatmapset-success-rate__label',
        Lang.get 'beatmaps.beatmapset.show.extra.success-rate.rate',
          percentage: percentage

      div className: 'beatmapset-success-rate__bar',
        div
          className: 'beatmapset-success-rate__bar beatmapset-success-rate__bar--fill'
          style:
            width: "#{percentage}%"


      div className: 'beatmapset-success-rate__chart-area',
        p
          className: 'beatmapset-success-rate__label'
          Lang.get 'beatmaps.beatmapset.show.extra.success-rate.points'


        div className: 'beatmapset-success-rate__legend',
          legend.map (m) ->
            div className: 'beatmapset-success-rate__legend-item', key: m,
              span className: 'beatmapset-success-rate__legend-label', Lang.get "beatmaps.beatmapset.show.extra.success-rate.#{m}"
              div className: "beatmapset-success-rate__legend-color beatmapset-success-rate__legend-color--#{m}"

        div
          className: 'beatmapset-success-rate__chart'
          ref: 'chart'
