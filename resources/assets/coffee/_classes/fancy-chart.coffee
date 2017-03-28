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

class @FancyChart
  margins:
    top: 25
    right: 20
    bottom: 10
    left: 0


  constructor: (area, @options = {}) ->
    @options.scales ||= {}
    @options.scales.x ||= d3.scaleTime()
    @options.scales.y ||= d3.scaleLinear()

    @area = d3.select(area)

    @svg = @area.append 'svg'

    @svgWrapper = @svg.append 'g'

    @svgLine = @svgWrapper.append 'path'
      .classed 'fancy-graph__line', true
      .attr 'opacity', 0

    @line = d3.line()
      .curve d3.curveMonotoneX
    @svgEndCircle = @svgWrapper.append 'circle'
      .classed 'fancy-graph__circle', true
      .attr 'r', 2
      .attr 'opacity', 0

    data = JSON.parse $($(area).data('src')).text()
    @loadData data


  loadData: (data) =>
    @data = data
    @svgLine.datum @data

    @reveal()


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
      .attr 'transform', "translate(#{@options.scales.x(@data[@data.length-1].x)+2}, #{@options.scales.y(@data[@data.length-1].y)})"


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawLine: =>
    @svgLine
      .attr 'stroke-dasharray', 0
      .attr 'd', @line


  reveal: =>
    @recalc()

    @svgLine
      .attr 'd', @line

    totalLength = @svgLine.node().getTotalLength()

    @svgLine
      .attr 'stroke-dasharray', totalLength
      .attr 'stroke-dashoffset', totalLength
      .transition()
        .delay 400
        .duration 1000
        .ease d3.easeSinOut
        .attr 'stroke-dashoffset', 0
        .attr 'opacity', 1

    @svgEndCircle
      .transition()
        .delay 1300
        .duration 300
        .ease d3.easeSinOut
        .attr 'opacity', 1


  recalc: =>
    @setDimensions()

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()
    @setLineSize()


  resize: =>
    @recalc()
    @drawLine()
