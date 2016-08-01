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

class BeatmapsetPage.RatingChart extends React.Component
  componentDidMount: ->
    @_renderChart()

  componentDidUpdate: ->
    @_renderChart()

  _renderChart: ->
    data = [
      {values: @props.ratings[1..]}
    ]
    
    unless @_ratingChart
      options =
        scales:
          x: d3.scale.linear()
          y: d3.scale.linear()
        className: 'beatmapset-rating-chart'

      @_ratingChart = new StackedBarChart @refs.chartArea, options

    @_ratingChart.loadData data

  render: ->
    div
      className: 'beatmapset-header__rating-chart beatmapset-rating-chart'
      ref: 'chartArea'
