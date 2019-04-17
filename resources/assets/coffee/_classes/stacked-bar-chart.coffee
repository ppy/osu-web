###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

class @StackedBarChart
  constructor: (area, @options = {}) ->
    @margins =
      top: 0
      right: 0
      bottom: 0
      left: 0

    @options.scales ?= {}
    @options.scales.x ?= d3.scaleLinear()
    @options.scales.y ?= d3.scaleLinear()

    blockClass = 'stacked-bar-chart'
    blockClass += " stacked-bar-chart--#{mod}" for mod in @options.modifiers

    @area = d3.select area
    @svg = @area
      .append 'svg'
      .attr 'class', blockClass

    @svgWrapper = @svg.append 'g'


  loadData: (data) ->
    @data = []

    for own type, values of data
      for own x, y of values
        @data[x] ?= []
        previousData = _.last(@data[x])

        @data[x].push
          type: type
          value: y
          height: if previousData? then previousData.value + previousData.height else 0

    @max = d3.max _.map @data, (m) -> _.sumBy m, 'value'

    @resize()


  setDimensions: ->
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScalesRange: ->
    @options.scales.x
      .range [0, @width]
      .domain [0, @data.length]

    @options.scales.y
      .range [0, @height]
      .domain [0, @max]


  setSvgSize: ->
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: ->
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawBars: ->
    groups = @svgWrapper
      .selectAll 'g'
      .data @data

    groups
      .enter()
      .append 'g'

    groups
      .attr 'transform', (d, i) => "translate(#{@options.scales.x i}, 0)"

    bars = groups
      .selectAll '.stacked-bar-chart__bar'
      .data (d) => d

    bars
      .enter()
      .append 'rect'
      .attr 'class', (d) => "stacked-bar-chart__bar stacked-bar-chart__bar--#{d.type}"


    bars
      .transition()
      .attr 'y', (d) => @height - @options.scales.y(d.value + d.height)
      .attr 'height', (d) => @options.scales.y d.value
      .attr 'width', @options.scales.x 1

    bars
      .exit()
      .remove()

    groups
      .exit()
      .remove()


  resize: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()

    @drawBars()
