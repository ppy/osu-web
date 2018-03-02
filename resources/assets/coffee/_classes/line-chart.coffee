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

class @LineChart
  constructor: (area, @options = {}) ->
    @margins =
      top: 20
      right: 20
      bottom: 50
      left: 80

    _.assign @margins, @options.margins

    @id = Math.floor(Math.random() * 1000)
    @options.scales ||= {}
    @options.scales.x ||= d3.scaleTime()
    @options.scales.y ||= d3.scaleLinear()

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

    @tooltip = @area.append 'div'
      .classed 'chart__tooltip', true
      .attr 'data-visibility', 'hidden'

    @tooltipContent = @tooltip.append 'div'
      .classed 'chart__tooltip-content', true

    @tooltipY = @tooltipContent.append 'div'
      .classed 'chart__tooltip-text chart__tooltip-text--y', true

    @tooltipX = @tooltipContent.append 'div'
      .classed 'chart__tooltip-text chart__tooltip-text--x', true

    @xAxis = d3.axisBottom()
      .tickSizeOuter 0
      .tickPadding 5

    @yAxis = d3.axisLeft().ticks(4)

    @line = d3.line()
      .curve(@options.curve ? d3.curveMonotoneX)


  loadData: (data) =>
    @data = data
    @svgLine.datum data

    @resize()


  createXAxisLine: =>
    @xAxisLine = @svg.append 'defs'
      .append 'linearGradient'
      .attr 'id', "x-axis-line-gradient-#{@id}"
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
      .tickSizeInner -@height
      .ticks @options.ticks?.x ? 15
      .tickFormat @options.formats?.x
      .tickValues @options.tickValues?.x

    @yAxis
      .scale @options.scales.y
      .tickSizeInner -@width
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
      .transition()
      .attr 'transform', "translate(0, #{@height})"
      .call @xAxis

    @svgYAxis
      .transition()
      .call @yAxis

    @svgXAxis.selectAll '.tick line'
      .classed 'chart__tick-line', true
      .attr 'stroke', "url(#x-axis-line-gradient-#{@id})"

    @svgYAxis.selectAll '.tick line'
      .classed 'chart__tick-line chart__tick-line--default', true

    @svgXAxis.selectAll '.domain'
      .classed 'u-hidden', true

    @svgYAxis.selectAll '.domain'
      .classed 'u-hidden', true

    @svgXAxis.selectAll 'text'
      .style 'text-anchor', 'start'
      .attr 'transform', 'rotate(45) translate(5, 0)'
      .classed 'chart__tick-text chart__tick-text--strong', true

    @svgYAxis.selectAll 'text'
      .classed 'chart__tick-text', true


  drawLine: =>
    @svgLine
      .transition()
      .attr 'd', @line


  showTooltip: =>
    Fade.in @tooltip.node()


  hideTooltip: =>
    Fade.out @tooltip.node()


  positionTooltip: =>
    x = @options.scales.x.invert(d3.mouse(@svgHoverArea.node())[0])
    i = @lookupIndexFromX x

    return unless i

    @showTooltip()
    Timeout.clear @_autoHideTooltip
    @_autoHideTooltip = Timeout.set 3000, @hideTooltip

    d = if x - @data[i - 1].x <= @data[i].x - x then @data[i - 1] else @data[i]
    coords = ['x', 'y'].map (axis) => @options.scales[axis] d[axis]

    # avoids blurry positioning
    coordsTooltip = [
      coords[0] + @margins.left
      coords[1] + @margins.top
    ].map (coord) => "#{Math.round coord}px"

    @tooltipX.html (@options.tooltipFormats?.x || @options.formats.x)(d.x)
    @tooltipY.html (@options.tooltipFormats?.y || @options.formats.y)(d.y)
    @tooltip
      .style 'transform', "translate(#{coordsTooltip.join(', ')})"


  resetTooltip: =>
    # Immediately hide so its position can be invisibly reset.
    @tooltip.style 'transition', 'none'
    @hideTooltip()
    @tooltip.style 'transform', null
    # Out of current loop so browser doesn't optimize out the styling
    # and ignores previously set transition override.
    Timeout.set 0, => @tooltip.style 'transition', null


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

    @resetTooltip()
