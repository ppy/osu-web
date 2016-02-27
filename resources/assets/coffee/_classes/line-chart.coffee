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
class @LineChart
  transition: 1000

  constructor: (area, @options = {}) ->
    @options.scales ||= {}
    @options.scales.x ||= d3.time.scale()
    @options.scales.y ||= d3.scale.linear()

    @area = d3.select(area)

    @svg = @area.append 'svg'

    @createXAxisLine()

    @svgWrapper = @svg.append 'g'
      .classed 'chart__wrapper', true

    @svgXAxis = @svgWrapper.append 'g'
      .classed 'chart__axis chart__axis--x', true

    @svgYAxis = @svgWrapper.append 'g'
      .classed 'chart__axis chart__axis--y', true

    @svgLine = @svgWrapper.append 'path'
      .classed 'chart__line', true

    @svgHoverArea = @svgWrapper.append 'rect'
      .classed 'chart__hover-area', true
      .on 'mouseout', @hideTooltip
      .on 'mousemove', @positionTooltip
      .on 'drag', @positionTooltip

    @svgHoverMark = @svgWrapper.append 'circle'
      .classed 'chart__hover-mark', true
      .attr 'data-visibility', 'hidden'
      .attr 'r', 5

    @tooltip = @area.append 'div'
      .classed 'chart__tooltip', true
      .attr 'data-visibility', 'hidden'

    @tooltipContainer = @tooltip.append 'div'
      .classed 'chart__tooltip-container', true

    @tooltipY = @tooltipContainer.append 'div'
      .classed 'chart__tooltip-text chart__tooltip-text--y', true

    @tooltipX = @tooltipContainer.append 'div'
      .classed 'chart__tooltip-text chart__tooltip-text--x', true

    @xAxis = d3.svg.axis()
      .ticks 15
      .outerTickSize 0
      .tickPadding 5
      .orient 'bottom'

    @yAxis = d3.svg.axis()
      .ticks 4
      .orient 'left'

    @line = d3.svg.line()
      .interpolate 'monotone'


  margins:
    top: 20
    right: 20
    bottom: 50
    left: 80


  loadData: (data) =>
    @data = data
    @svgLine.datum data

    @resize()


  createXAxisLine: () =>
    @xAxisLine = @svg.append 'defs'
      .append 'linearGradient'
      .attr 'id', 'x-axis-line-gradient'
      .attr 'gradientUnits', 'userSpaceOnUse'
      .attr 'x1', '0'
      .attr 'x2', '0'
      .attr 'y1', '-100%'
      .attr 'y2', '0'

    @xAxisLine.append 'stop'
      .classed 'chart__tick-gradient chart__tick-gradient--start', true
      .attr 'offset', '20%'

    @xAxisLine.append 'stop'
      .classed 'chart__tick-gradient chart__tick-gradient--end', true
      .attr 'offset', '100%'


  setDimensions: =>
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScalesRange: =>
    @options.scales.x
      .range [0, @width]
      .domain @options.domains?.x || d3.extent(@data, (d) => d.x)

    @options.scales.y
      .range [@height, 0]
      .domain @options.domains?.y || d3.extent(@data, (d) => d.y)


  setAxesSize: =>
    @xAxis
      .scale @options.scales.x
      .innerTickSize -@height
      .tickFormat @options.formats?.x
      .tickValues @options.tickValues?.x

    @yAxis
      .scale @options.scales.y
      .innerTickSize -@width
      .tickFormat @options.formats?.y
      .tickValues @options.tickValues?.y


  setLineSize: =>
    @line
      .x (d) => @options.scales.x d.x
      .y (d) => @options.scales.y d.y


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

  setHoverAreaSize: =>
    @svgHoverArea
      .attr 'width', @width
      .attr 'height', @height


  drawAxes: =>
    @svgXAxis
      .transition @transition
      .attr 'transform', "translate(0, #{@height})"
      .call @xAxis

    @svgYAxis
      .transition @transition
      .call @yAxis

    @svgXAxis.selectAll '.tick line'
      .classed 'chart__tick-line', true
      .attr 'stroke', 'url(#x-axis-line-gradient)'

    @svgYAxis.selectAll '.tick line'
      .classed 'chart__tick-line chart__tick-line--default', true

    @svgXAxis.selectAll '.domain'
      .classed 'chart__tick-line chart__tick-line--default', true

    @svgYAxis.selectAll '.domain'
      .classed 'chart__tick-line', true

    @svgXAxis.selectAll 'text'
      .style 'text-anchor', 'start'
      .attr 'transform', 'rotate(45) translate(5, 0)'
      .classed 'chart__tick-text chart__tick-text--strong', true

    @svgYAxis.selectAll 'text'
      .classed 'chart__tick-text', true


  drawLine: =>
    @svgLine
      .transition @transition
      .attr 'd', @line


  showTooltip: =>
    Fade.in @svgHoverMark.node()
    Fade.in @tooltip.node()


  hideTooltip: =>
    Fade.out @svgHoverMark.node()
    Fade.out @tooltip.node()


  positionTooltip: =>
    x = @options.scales.x.invert(d3.mouse(@svgHoverArea.node())[0])
    i = @lookupIndexFromX x

    return unless i

    @showTooltip()
    clearTimeout @_autoHideTooltip
    @_autoHideTooltip = setTimeout @hideTooltip, 3000

    d = if x - @data[i - 1].x <= @data[i].x - x then @data[i - 1] else @data[i]
    coords = ['x', 'y'].map (axis) => @options.scales[axis] d[axis]

    # avoids blurry positioning
    coordsTooltip = [
      coords[0] + @margins.left
      coords[1] + @margins.top
    ].map (coord) => "#{Math.round coord}px"

    @svgHoverMark
      .attr 'transform', "translate(#{coords.join(', ')})"

    @tooltipX.html (@options.tooltipFormats?.x || @options.formats.x)(d.x)
    @tooltipY.html (@options.tooltipFormats?.y || @options.formats.y)(d.y)
    @tooltip
      .style 'transform', "translate(#{coordsTooltip.join(', ')})"

    unless @tooltipContainer.attr('data-width-set') == '1'
      @tooltipContainer
        .attr 'data-width-set', '1'
        .style 'width', "#{@tooltipContainer.node().getBoundingClientRect().width * 1.2}px"


  lookupIndexFromX: (x) =>
    d3.bisector((d) => d.x).left @data, x


  resize: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()
    @setHoverAreaSize()
    @setAxesSize()
    @setLineSize()

    @drawAxes()
    @drawLine()
