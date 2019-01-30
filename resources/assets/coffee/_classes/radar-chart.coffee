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

class @RadarChart
  constructor: (area, @options = {}) ->
    @margins =
      top: 30
      right: 30
      bottom: 0
      left: 30

    @options.scale ||= d3.scaleLinear()

    @area = d3.select area
    @svg = @area.append 'svg'

    # angle between two neighboring axes
    @angleStep = (Math.PI * 2) / @options.axes

    @svgWrapper = @svg.append 'g'

    group = @svgWrapper.append 'g'
    @circles = for i in [0..@options.ticks - 1]
      group.append 'circle'
        .classed "#{@options.className}__circle", true

    @axes = for i in [0..@options.axes - 1]
      group = @svgWrapper.append 'g'
      axis: group.append('line').classed("#{@options.className}__axis", true)
      dots: for i in [0..@options.dots - 1]
        group.append('circle').classed("#{@options.className}__dot", true)
      label: group.append('text').classed("#{@options.className}__label", true)

    @centerDot = @svgWrapper.append 'circle'
      .classed "#{@options.className}__dot", true

    @selectedArea = @svgWrapper.append 'path'
      .classed "#{@options.className}__area", true

    @pointsGroup = @svgWrapper.append 'g'

  loadData: (data) =>
    @values = data
    @resize true

  setDimensions: ->
    areaDims = @area.node().getBoundingClientRect()

    width = areaDims.width

    if @options.maxWidth and width > @options.maxWidth
      width = @options.maxWidth

    @diameter = width - (@margins.left + @margins.right)
    @radius = @diameter / 2

    @dotRadius = width / 200

    @center =
      x: @radius
      y: @radius

  setScalesRange: ->
    @options.scale
      .range [0, @radius]
      .domain @options.domain

  setSvgSize: ->
    @svg
      .attr 'width', @diameter + (@margins.left + @margins.right)
      .attr 'height', @diameter + (@margins.top + @margins.bottom)

  setWrapperSize: ->
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

  setCirclesSize: ->
    len = @radius / @options.ticks

    for circle, i in @circles
      circle
        .attr 'cx', @center.x
        .attr 'cy', @center.y
        .attr 'r', len * (i + 1)

    @centerDot
      .attr 'cx', @center.x
      .attr 'cy', @center.y
      .attr 'r', @dotRadius

  setAxesSize: ->
    @angleStep = (Math.PI * 2) / @options.axes
    angle = Math.PI / 2 # the first axis is rotated 90 degrees from the x axis
    len = @radius / @options.dots; # distance between two neighboring dots

    x1 = @center.x
    y1 = @center.y
    x2 = @center.x
    y2 = @center.y - @radius

    for axis, i in @axes
      axis.axis
        .attr 'x1', x1
        .attr 'y1', y1
        .attr 'x2', x2
        .attr 'y2', y2

      [x2, y2] = @_rotatePoint x1, y1, x2, y2, @angleStep

      for dot, j in axis.dots
        [x, y] = @_extendPoint @center.x, @center.y, len * (j + 1), angle

        dot
          .attr 'cx', x
          .attr 'cy', y
          .attr 'r', @dotRadius

      [x, y] = @_extendPoint @center.x, @center.y, @radius + 10, angle

      axis.label
        .attr 'x', x
        .attr 'y', y
        .attr 'text-anchor', if x > @center.x then 'start' else if x < @center.x then 'end' else 'middle'
        .text @values[i].label

      angle += @angleStep

  calculatePoints: ->
    @data = @values.map (v, i) =>
      len = @options.scale v.value
      angle = (Math.PI / 2) + @angleStep * i

      [x, y] = @_extendPoint @center.x, @center.y, len, angle

      x: x
      y: y

  drawArea: (animateArea) ->
    line = d3.line()
      .x (d) -> d.x
      .y (d) -> d.y
      .interpolate 'linear-closed'

    area = @selectedArea

    if animateArea
      area = area.transition()

    area.attr 'd', line @data

  _extendPoint: (cx, cy, length, angle) ->
    s = Math.sin angle
    c = Math.cos angle

    [cx + length * c, cy - length * s]

  _rotatePoint: (x1, y1, x2, y2, angle) ->
    s = Math.sin angle
    c = Math.cos angle

    x2 -= x1
    y2 -= y1

    [x1 + (x2 * c + y2 * s), y1 + (y2 * c - x2 * s)]

  resize: (animate) =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()

    @setCirclesSize()
    @setAxesSize()

    @calculatePoints()

    @drawArea animate
