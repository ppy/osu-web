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
{div} = React.DOM

class BeatmapsetPage.DifficultyChart extends React.Component
  componentDidMount: ->
    @_renderChart()

  componentDidUpdate: ->
    @_renderChart()

  componentWillUnmount: ->
    $(window).off '.beatmapsetPageDifficultyChart'

  _renderChart: ->
    data = [
      {value: @props.beatmap.cs, label: Lang.get 'beatmaps.beatmapset.show.stats.chart.cs'},
      {value: @props.beatmap.drain, label: Lang.get 'beatmaps.beatmapset.show.stats.chart.hp'}
      {value: @props.beatmap.accuracy, label: Lang.get 'beatmaps.beatmapset.show.stats.chart.od'},
      {value: @props.beatmap.ar, label: Lang.get 'beatmaps.beatmapset.show.stats.chart.ar'},
      {value: @props.beatmap.difficulty_rating, label: Lang.get 'beatmaps.beatmapset.show.stats.chart.sd'},
    ]

    unless @_difficultyChart
      options =
        domain: [0, 10]
        scale: d3.scale.linear()
        ticks: 2
        axes: 5
        dots: 10
        maxWidth: 400 # prevents the chart to be overly wide when on mobile
        className: 'beatmapset-diffchart'

      @_difficultyChart = new RadarChart @refs.chartArea, options

      $(window).on 'throttled-resize.beatmapsetPageDifficultyChart', () => @_difficultyChart.resize false

    @_difficultyChart.loadData data

  render: ->
    div className: 'page-contents__content beatmapset-diffchart',
      div ref: 'chartArea'
