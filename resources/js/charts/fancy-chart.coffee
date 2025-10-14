# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class FancyChart
  constructor: (area) ->
    @options = scales:
      x: d3.scaleLinear()
      y: d3.scaleLinear()

    endCircleRadius = 3
    @marginRight = endCircleRadius

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
      .attr 'r', endCircleRadius
      .attr 'opacity', 0

    data = JSON.parse area.dataset.chartData
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
    @width = areaDims.width - @marginRight
    @height = areaDims.height


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
        .attr 'cx', Math.round(@options.scales.x(lastPoint.x))
        .attr 'cy', Math.round(@options.scales.y(lastPoint.y))


  setSvgSize: =>
    @svg
      .attr 'width', @width + @marginRight
      .attr 'height', @height


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
    @setLineSize()


  resize: =>
    @recalc()
    @drawLine()
