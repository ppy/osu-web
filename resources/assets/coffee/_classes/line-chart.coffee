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
  constructor: (@area, @formats) ->
    @x = d3.time.scale()

    @y = d3.scale.linear()

    @svg = d3.select(@area).append 'svg'

    @createXAxisLine()

    @svgWrapper = @svg.append 'g'
      .classed 'chart__wrapper', true

    @svgXAxis = @svgWrapper.append 'g'
      .classed 'chart__axis chart__axis--x', true

    @svgYAxis = @svgWrapper.append 'g'
      .classed 'chart__axis chart__axis--y', true

    @svgLine = @svgWrapper.append 'path'
      .classed 'chart__line', true

    @xAxis = d3.svg.axis()
      .ticks 15
      .outerTickSize 0
      .tickPadding 5
      .tickFormat @formats.x
      .orient 'bottom'

    @yAxis = d3.svg.axis()
      .ticks 4
      .tickFormat @formats.y
      .orient 'left'

    @line = d3.svg.line()
      .interpolate 'monotone'


  margins:
    top: 20
    right: 20
    bottom: 50
    left: 100


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
    areaDims = @area.getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScalesRange: =>
    @x
      .range [0, @width]
      .domain d3.extent(@data, (d) => d.x)
    @y
      .range [@height, 0]
      .domain d3.extent(@data, (d) => d.y)


  setAxesSize: =>
    @xAxis
      .scale @x
      .innerTickSize -@height

    @yAxis
      .scale @y
      .innerTickSize -@width


  setLineSize: =>
    @line
      .x (d) => @x d.x
      .y (d) => @y d.y


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'width', @width
      .attr 'height', @height
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawAxes: =>
    @svgXAxis
      .attr 'transform', "translate(0, #{@height})"
      .call @xAxis

    @svgYAxis
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
      .style 'text-anchor', ''
      .classed 'chart__tick-text', true

    @svgYAxis.selectAll 'text'
      .classed 'chart__tick-text', true


  drawLine: =>
    @svgLine
      .attr 'd', @line


  resize: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()
    @setAxesSize()
    @setLineSize()

    @drawAxes()
    @drawLine()
