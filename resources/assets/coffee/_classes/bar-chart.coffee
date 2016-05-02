###
# Copyright 2016 ppy Pty. Ltd.
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

class @BarChart
  transition: 1000

  margins:
    top: 0
    right: 0
    bottom: 0
    left: 0

  constructor: (area, @options = {}) ->
    @options.scales.x ||= d3.scale.linear()
    @options.scales.y ||= d3.scale.linear()

    @area = d3.select area
    @svg = @area.append 'svg'

    @svgWrapper = @svg.append 'g'

  loadData: (data) ->
    @data = data

    @resize()

  setDimensions: ->
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)

  setScalesRange: ->
    @options.scales.x
      .range [0, @width]
      .domain [0, @data[0].length - 1] # for now we assume that datasets have equal lengths

    @options.scales.y
      .range [0, @height]
      .domain @options.domain

  setSvgSize: ->
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)

  setWrapperSize: ->
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

  drawBars: ->
    for data, i in @data
      bars = @svgWrapper
        .selectAll ".#{@options.className}__bar--#{i}"
        .data data

      bars
        .enter()
        .append 'rect'
        .classed "#{@options.className}__bar #{@options.className}__bar--#{i}", true

      bars
        .transition @transition
        .attr 'x', (d, i) => @options.scales.x i
        .attr 'y', (d) => @options.scales.y d
        .attr 'height', (d) => @height - @options.scales.y d
        .attr 'width', @options.scales.x 1

      bars
        .exit()
        .remove()

  resize: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()

    @drawBars()
