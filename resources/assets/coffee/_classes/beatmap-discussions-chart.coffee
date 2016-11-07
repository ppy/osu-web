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
bn = 'beatmap-discussions-chart'

class @BeatmapDiscussionsChart
  constructor: (area, @length) ->
    @dimensions =
      chartHeight: 120
      totalHeight: 150
      xAxisHeight: 2
      barTop: 50

    @dimensions.labelHeight = @dimensions.totalHeight - @dimensions.chartHeight
    @dimensions.labelTop = @dimensions.totalHeight - @dimensions.labelHeight
    @dimensions.iconTop = @dimensions.labelTop + (@dimensions.labelHeight / 2)
    @dimensions.barHeight = @dimensions.chartHeight - @dimensions.barTop
    @dimensions.xAxisTop = @dimensions.chartHeight - @dimensions.xAxisHeight

    @margins =
      top: 0
      right: 40
      bottom: 0
      left: 40

    @scaleX = d3.scale.linear()
      .domain [0, @length]
      .nice()

    @area = d3
      .select(area)
      .append 'div'
      .classed bn, true

    @svg = @area.append 'svg'

    @svgWrapper = @svg.append 'g'
      .classed "#{bn}__wrapper", true

    @svgChartArea = @svgWrapper.append 'rect'
      .attr 'x', -@margins.left
      .attr 'y', 0
      .attr 'height', @dimensions.chartHeight
      .classed "#{bn}__chart-area", true

    @svgLabelArea = @svgWrapper.append 'rect'
      .attr 'x', -@margins.left
      .attr 'y', @dimensions.labelTop
      .attr 'height', @dimensions.labelHeight
      .classed "#{bn}__label-area", true

    @svgXAxis = @svgWrapper.append 'rect'
      .attr 'x', -@margins.left
      .attr 'y', @dimensions.xAxisTop
      .attr 'height', @dimensions.xAxisHeight
      .classed "#{bn}__axis #{bn}__axis--x", true

    @svgPoints = @svgWrapper.append 'g'
      .selectAll ".#{bn}__point"

    @xAxis = d3.svg.axis()
      .ticks 0
      .outerTickSize 0
      .orient 'bottom'


  loadData: (data) =>
    @data = _.orderBy data, 'timestamp'

    @svgPoints = @svgPoints.data @data, (d) => d.id

    points = @svgPoints.enter()
      .append 'a'
      .attr 'xlink:href', (d) => "#/#{d.id}"
      .attr 'data-target-id', (d) => d.id
      .attr 'class', (d) =>
        "#{bn}__point #{bn}__point--#{d.message_type}"
      .on 'click', (d) =>
        d3.event.preventDefault()
        $.publish 'beatmapDiscussion:jump', id: d.id

    points
      .append 'line'
      .classed "#{bn}__bar", true
      .attr 'x1', 0
      .attr 'x2', 0
      .attr 'y1', @dimensions.barTop
      .attr 'y2', @dimensions.barTop + @dimensions.barHeight

    points
      .append 'text'
      .classed "#{bn}__icon", true
      .style 'text-anchor', 'middle'
      .attr 'y', @dimensions.iconTop
      .append 'tspan'
      .classed 'fa', true
      .html (d) =>
        BeatmapDiscussionHelper.messageType.iconText[d.message_type]

    @svgPoints.exit().remove()

    @resize()


  setDimensions: =>
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScales: =>
    @scaleX
      .range [0, @width]


  setAxisSize: =>
    @xAxis
      .scale @scaleX


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawAreas: =>
    width = @width + (@margins.left + @margins.right)
    @svgChartArea.attr 'width', width
    @svgLabelArea.attr 'width', width


  drawXAxis: =>
    @svgXAxis.attr 'width', @width + (@margins.left + @margins.right)


  positionPoints: =>
    @svgPoints
      .attr 'transform', (d) => "translate(#{Math.round(@scaleX(d.timestamp))}, 0)"



  resize: =>
    @setDimensions()

    @setScales()
    @setSvgSize()
    @setWrapperSize()
    @setAxisSize()

    @drawXAxis()
    @drawAreas()
    @positionPoints()
