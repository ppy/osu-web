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
  constructor: (@area, data) ->

    startDate = moment().subtract(data.length, 'days')

    @data = data
      .filter (rank) => rank > 0
      .map (rank) =>
        date: startDate.add(1, 'day').clone().toDate()
        # rank must be drawn inverted.
        rank: -rank

    @setDimensions()

    @x = d3.time.scale()
      .domain d3.extent(@data, (d) => d.date)

    @y = d3.scale.linear()
      .domain d3.extent(@data, (d) => d.rank)

    @setScalesRange()

    @svg = d3.select(@area).append 'svg'
    @setSvgSize()

    @createXAxisLine()

    @wrapper = @svg.append 'g'
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

    @xAxis = d3.svg.axis()
      .ticks 15
      .outerTickSize 0
      .tickPadding 5
      .tickFormat @xFormat
      .orient 'bottom'

    @yAxis = d3.svg.axis()
      .ticks 4
      .tickFormat @yFormat
      .orient 'left'

    @line = d3.svg.line()
      .interpolate 'monotone'

    @svgXAxis = @wrapper.append 'g'
      .attr 'class', 'chart__axis chart__axis--x'

    @svgYAxis = @wrapper.append 'g'
      .attr 'class', 'chart__axis chart__axis--y'

    @svgLine = @wrapper.append 'path'
      .attr 'class', 'chart__line'
      .datum @data

    @resize()

    $(window).on 'throttled-resize', @resize


  margins:
    top: 20
    right: 20
    bottom: 50
    left: 100


  xFormat: d3.time.format '%b-%-d'


  yFormat: (d) => (-d).toLocaleString()


  createXAxisLine: =>
    @xAxisLine = @svg.append 'defs'
      .append 'linearGradient'
      .attr 'id', 'x-axis-line-gradient'
      .attr 'gradientUnits', 'userSpaceOnUse'
      .attr 'x1', '0'
      .attr 'x2', '0'
      .attr 'y1', '-100%'
      .attr 'y2', '0'

    @xAxisLine.append 'stop'
      .attr 'offset', '20%'
      .attr 'stop-color', '#fff'

    @xAxisLine.append 'stop'
      .attr 'offset', '100%'
      .attr 'stop-color', '#ccc'


  setDimensions: =>
    areaDims = @area.getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScalesRange: =>
    @x.range [0, @width]
    @y.range [@height, 0]


  setAxesSize: =>
    @xAxis
      .scale @x
      .innerTickSize -@height

    @yAxis
      .scale @y
      .innerTickSize -@width


  setLineSize: =>
    @line
      .x (d) => @x d.date
      .y (d) => @y d.rank


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @wrapper
      .attr 'width', @width
      .attr 'height', @height


  drawAxes: =>
    @svgXAxis
      .attr 'transform', "translate(0, #{@height})"
      .call @xAxis

    @svgYAxis
      .call @yAxis

    @svgXAxis.selectAll 'text'
      .style 'text-anchor', ''

    for axis in [@svgXAxis, @svgYAxis]
      axis.selectAll '.tick line, .tick path'
        .attr 'class', 'chart__tick-line chart__tick-line--tick'

      axis.selectAll '.domain'
        .attr 'class', 'chart__tick-line chart__tick-line--domain'

      axis.selectAll 'text'
        .attr 'class', 'chart__tick-text'


  drawLine: =>
    @svgLine
      .attr 'd', @line


  resize: =>
    @setDimensions()
    @setSvgSize()
    @setWrapperSize()
    @setScalesRange()
    @setAxesSize()
    @setLineSize()

    @drawAxes()
    @drawLine()
