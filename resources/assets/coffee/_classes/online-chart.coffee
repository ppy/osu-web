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

class @OnlineChart
  constructor: (area, @options = {}) ->
    @options.scales ||= {}
    @options.scales.x ||= d3.scaleTime()
    @options.scales.y ||= d3.scaleLinear()

    @area = d3.select(area)

    @svg = @area.append 'svg'

    @svgWrapper = @svg.append 'g'
      .classed 'chart__wrapper', true

    @svgLine = @svgWrapper.append 'path'
      .classed 'chart__line chart__line--thin chart__line--yellow', true

    @line = d3.line()
      .curve d3.curveMonotoneX

    data = []
    _.forEach(JSON.parse($("#json-stats").text()), (e, i) -> data.push(new Object({'x': i, 'y': e.users_osu})))

    @svgEndCircle = @svgWrapper.append 'circle'
      .classed 'chart__hover-mark chart__hover-mark--small chart__line--yellow', true
      .attr 'r', 2

    @loadData data

  margins:
    top: 25
    right: 20
    bottom: 10
    left: 0


  loadData: (data) =>
    @data = data
    @svgLine.datum @data

    @resize()

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


  setLineSize: =>
    @line
      .x (d) => @options.scales.x d.x
      .y (d) => @options.scales.y d.y

    @svgEndCircle
      .transition()
      .attr 'transform', "translate(#{@options.scales.x(@data[@data.length-1].x)}, #{@options.scales.y(@data[@data.length-1].y)})"


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

  drawLine: =>
    @svgLine
      .transition()
      .attr 'd', @line

  resize: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()
    @setLineSize()

    @drawLine()
