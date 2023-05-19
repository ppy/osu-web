# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { fadeIn, fadeOut } from 'utils/fade'
import { parseJsonNullable } from 'utils/json'

export default class FancyChart
  constructor: (area, @options = {}) ->
    @options.scales ?= {}
    @options.scales.x ?= d3.scaleLinear()
    @options.scales.y ?= d3.scaleLinear()

    @margins =
      top: 25
      right: 20
      bottom: 10
      left: 0

    @area = d3.select(area)

    @area.selectAll('.fancy-graph').remove()

    @svg = @area
      .append 'svg'
      .classed 'fancy-graph', true

    @svgWrapper = @svg.append 'g'

    @svgLine = @svgWrapper.append 'path'
      .classed 'fancy-graph__line', true
      .attr 'opacity', 0

    @line = d3.line()
      .curve d3.curveMonotoneX

    @svgEndCircle = @svgWrapper.append 'circle'
      .classed 'fancy-graph__circle', true
      .attr 'r', 2
      .attr 'opacity', 0

    @svgHoverArea = @svg.append 'rect'
      .classed 'fancy-graph__hover-area', true
      .on 'mouseout', @hoverEnd
      .on 'mousemove', @hoverRefresh
      .on 'drag', @hoverRefresh

    @svgHoverMark = @svgWrapper.append 'circle'
      .classed 'fancy-graph__circle', true
      .attr 'data-visibility', 'hidden'
      .attr 'r', 2

    data = parseJsonNullable area.dataset.src
    @loadData data


  hide: =>
    @svgEndCircle.attr 'opacity', 0
    @svgLine.attr 'opacity', 0


  loadData: (data) =>
    return if _.isEqual data, @data

    @data = data ? []
    @svgLine.datum @data

    @reveal()


  setDimensions: =>
    areaDims = @area.node().getBoundingClientRect()
    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setHoverAreaSize: =>
    @svgHoverArea
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setScalesRange: =>
    @options.scales.x
      .range [0, @width]
      .domain @options.domains?.x ? d3.extent(@data, (d) => d.x)

    @options.scales.y
      .range [@height, 0]
      .domain @options.domains?.y ? d3.extent(@data, (d) => d.y)


  setLineSize: =>
    @line
      .x (d) => @options.scales.x d.x
      .y (d) => @options.scales.y d.y

    lastPoint = _.last(@data)

    if lastPoint?
      @svgEndCircle
        .attr 'transform', "translate(#{@options.scales.x(lastPoint.x)}, #{@options.scales.y(lastPoint.y)})"


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawLine: =>
    @svgLine
      .attr 'stroke-dasharray', 0
      .attr 'd', @line


  reveal: =>
    return @hide() if !@data[0]?

    @recalc()

    @svgLine
      .attr 'd', @line

    totalLength = @svgLine.node().getTotalLength()

    @svgEndCircle
      .attr 'opacity', 0

    @svgLine
      .attr 'stroke-dasharray', totalLength
      .attr 'stroke-dashoffset', totalLength
      .transition()
        .delay 400
        .duration 1000
        .ease d3.easeSinOut
        .attr 'stroke-dashoffset', 0
        .attr 'opacity', 1

    @svgEndCircle
      .transition()
        .delay 1300
        .duration 300
        .ease d3.easeSinOut
        .attr 'opacity', 1


  recalc: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()
    @setLineSize()
    @setHoverAreaSize()


  resize: =>
    @recalc()
    @drawLine()


  hoverEnd: =>
    fadeOut @svgHoverMark.node()
    $.publish "fancy-chart:hover-#{@options.hoverId}:end"


  hoverRefresh: (event) =>
    return if !@options.hoverId?
    return if !@data[0]?

    x = @options.scales.x.invert(d3.pointer(event)[0] - @margins.left)
    i = @lookupIndexFromX x

    return unless i?

    fadeIn @svgHoverMark.node()
    Timeout.clear @_hoverTimeout
    @_hoverTimeout = Timeout.set 3000, @hoverEnd

    d =
      if i == 0
        @data[0]
      else if i >= @data.length
        _.last @data
      else if (x - @data[i - 1].x) <= (@data[i].x - x)
        @data[i - 1]
      else
        @data[i]
    coords = ['x', 'y'].map (axis) => @options.scales[axis] d[axis]

    @svgHoverMark.attr 'transform', "translate(#{coords.join(', ')})"

    $.publish "fancy-chart:hover-#{@options.hoverId}:refresh", data: d


  lookupIndexFromX: (x) =>
    d3.bisector((d) -> d.x).left @data, x
