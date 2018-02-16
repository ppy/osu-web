###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

bn = 'beatmap-discussions-chart'

class @BeatmapDiscussionsChart
  constructor: (area, @length) ->
    @id = Math.floor(Math.random() * 1000)
    @dimensions =
      chartHeight: 120
      totalHeight: 150
      xAxisHeight: 2
      barTop: 0
      targetAreaWidth: 10

    @dimensions.labelHeight = @dimensions.totalHeight - @dimensions.chartHeight
    @dimensions.labelTop = @dimensions.totalHeight - @dimensions.labelHeight
    @dimensions.iconTop = @dimensions.labelTop + (@dimensions.labelHeight / 2)
    @dimensions.barHeight = @dimensions.chartHeight - @dimensions.barTop
    @dimensions.xAxisTop = @dimensions.chartHeight - @dimensions.xAxisHeight
    @dimensions.targetAreaHeight = @dimensions.barHeight + @dimensions.labelHeight

    @margins =
      top: 0
      right: 40
      bottom: 0
      left: 40

    @scaleX = d3.scaleLinear()
      .domain [0, @length]
      .nice()

    @area = d3
      .select(area)
      .append 'div'
      .classed bn, true

    @svg = @area.append 'svg'

    lineGradient = @svg.append 'defs'
      .append 'linearGradient'
      .attr 'id', "bar-gradient-#{@id}"
      .attr 'gradientUnits', 'userSpaceOnUse'
      .attr 'x1', 0
      .attr 'x2', 0
      .attr 'y1', 0
      .attr 'y2', '100%'

    lineGradient.append 'stop'
      .classed "#{bn}__bar-gradient #{bn}__bar-gradient--start", true
      .attr 'offset', '30%'

    lineGradient.append 'stop'
      .classed "#{bn}__bar-gradient", true
      .attr 'offset', '80%'

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

    @svgPointsContainer = @svgWrapper.append 'g'

    @xAxis = d3.axisBottom()
      .ticks 0
      .tickSizeOuter 0


  loadData: (data) =>
    @data = _.orderBy data, 'timestamp'

    @svgPoints = @svgPointsContainer
      .selectAll ".#{bn}__point"
      .data @data, (d) => d.id

    svgPointsEnter = @svgPoints.enter()
      .append 'a'
      .classed "#{bn}__point", true

    svgPointsEnter
      .append 'line'
      .classed "#{bn}__bar", true
      .attr 'x1', 0
      .attr 'x2', 0
      .attr 'y1', @dimensions.barTop
      .attr 'y2', @dimensions.barTop + @dimensions.barHeight
      .attr 'stroke', "url(#bar-gradient-#{@id})"

    svgPointsEnter
      .append 'rect'
      .classed "#{bn}__target-area", true
      .attr 'x', -@dimensions.targetAreaWidth / 2
      .attr 'width', @dimensions.targetAreaWidth
      .attr 'y', @dimensions.barTop
      .attr 'height', @dimensions.targetAreaHeight

    svgPointsEnter
      .append 'text'
      .classed "#{bn}__icon", true
      .style 'text-anchor', 'middle'
      .attr 'y', @dimensions.iconTop

    @svgPoints.exit().remove()

    @svgPoints = svgPointsEnter.merge(@svgPoints)

    @svgPoints
      .attr 'xlink:href', (d) =>
        BeatmapDiscussionHelper.url discussion: d
      .attr 'class', (d) ->
        type = if d.resolved then 'resolved' else _.kebabCase(d.message_type)
        "js-beatmap-discussion--jump #{bn}__point #{bn}__point--#{type}"
      .attr 'title', (d) ->
        BeatmapDiscussionHelper.formatTimestamp d.timestamp
      .attr 'data-tooltip-position', 'bottom center'
      .attr 'data-tooltip-modifiers', 'extra-padding'

    # refresh the icons
    @svgPoints
      .select(".#{bn}__icon > tspan").remove()

    @svgPoints
      .select ".#{bn}__icon"
      .append 'tspan'
      .classed 'fa', true
      .html (d) =>
        type = if d.resolved then 'resolved' else _.camelCase(d.message_type)
        BeatmapDiscussionHelper.messageType.iconText[type]

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
    @svgPoints.attr 'transform', (d) =>
      "translate(#{Math.round(@scaleX(d.timestamp))}, 0)"


  resize: =>
    @setDimensions()

    @setScales()
    @setSvgSize()
    @setWrapperSize()
    @setAxisSize()

    @drawXAxis()
    @drawAreas()
    @positionPoints()
