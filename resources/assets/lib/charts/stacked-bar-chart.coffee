# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class StackedBarChart
  constructor: (@area, @options = {}) ->
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

    @svg = d3.select(@area)
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


  reattach: (newArea) =>
    return if !newArea? || newArea == @area

    @area = newArea
    @area.append(@svg.node())


  setDimensions: ->
    areaDims = @area.getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScalesRange: ->
    @options.scales.x
      .range [0, @width]
      .domain [0, @data.length]

    @options.scales.y
      .range [0, @height]
      .domain [0, Math.max(@max, 1)]


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
      .attr 'width', @options.scales.x 1
      .attr 'y', @height


    bars
      .transition()
      .attr 'y', (d) => @height - @options.scales.y(d.value + d.height)
      .attr 'height', (d) => @options.scales.y d.value

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
