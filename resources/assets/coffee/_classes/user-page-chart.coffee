###
# Copyright 2015-2016 ppy Pty. Ltd.
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

class @UserPageChart
  container: document.getElementsByClassName 'js-user-header--chart-area'

  margins:
    top: 10
    bottom: 5
    left: 0
    right: 20

  dotInnerRadius: 1.5
  dotOuterRadius: 2.5

  constructor: ->
    $(document).on 'turbolinks:load', @initialize

  initialize: =>
    return if !@container[0]?

    @svg = d3.select '.js-user-header--chart-area'
      .append 'svg'

    @svgWrapper = @svg
      .append 'g'

    @svgLine = @svgWrapper.append 'path'
      .classed 'user-header__chart-line', true

    @line = d3.svg.line()
      .interpolate 'monotone'

    @dotOuter = @svgWrapper.append 'circle'
      .classed 'user-header__chart-dot user-header__chart-dot--outer', true

    @dotInner = @svgWrapper.append 'circle'
      .classed 'user-header__chart-dot', true


    @scales =
      x: d3.scale.linear()
      y: d3.time.scale()

    @loadData()

  loadData: ->
    data = osu.parseJson 'json-stats'

    parseDate = d3.time.format('%Y-%m-%d %H:%M:%S').parse

    @data = _.map data, (d) ->
      date: parseDate(d.date)
      count: d.users_osu

    @max = d3.max @data, (d) -> d.count

    @svgLine.datum @data
    @resize()


  setDimensions: ->
    areaDims = @container[0].getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)

  setScalesRange: ->
    @scales.x
      .range [0, @width]
      .domain d3.extent @data, (d) -> d.date

    @scales.y
      .range [0, @height]
      .domain [0, @max]

  setSvgSize: ->
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)

  setWrapperSize: ->
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

  setLineSize: ->
    @line
      .x (d) => @scales.x d.date
      .y (d) => @scales.y d.count

  drawLine: ->
    @svgLine.transition()
      .attr 'd', @line

  drawDots: ->
    position = _.last @data

    @dotOuter
      .attr 'cx', @scales.x position.date
      .attr 'cy', @scales.y position.count
      .attr 'r', @dotOuterRadius

    @dotInner
      .attr 'cx', @scales.x position.date
      .attr 'cy', @scales.y position.count
      .attr 'r', @dotInnerRadius

  resize: ->
    @setDimensions()
    @setScalesRange()
    @setSvgSize()

    @setLineSize()
    @drawLine()
    @drawDots()
