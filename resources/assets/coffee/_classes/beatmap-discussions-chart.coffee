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
bn = 'beatmap-discussions-chart'

class @BeatmapDiscussionsChart
  transition: 1000

  constructor: (area, @length) ->
    @scaleX = d3.scale.linear()
      .domain [0, @length]
      .nice()

    @area = d3.select(area)

    @svg = @area.append 'svg'

    @svgWrapper = @svg.append 'g'
      .classed "#{bn}__wrapper", true

    @svgXAxis = @svgWrapper.append 'rect'
      .attr 'x', 0
      .attr 'y', 70
      .attr 'height', 5
      .classed "#{bn}__axis #{bn}__axis--x", true

    @svgPoints = @svgWrapper.append 'g'
      .selectAll ".#{bn}__point"

    @xAxis = d3.svg.axis()
      .ticks 0
      .outerTickSize 0
      .orient 'bottom'


  margins:
    top: 0
    right: 40
    bottom: 0
    left: 40


  loadData: (data) =>
    @data = _.orderBy data, 'timestamp'

    @svgPoints = @svgPoints.data @data, (d) => d.id

    points = @svgPoints.enter()
      .append 'g'
      .attr 'class', (d) =>
        "#{bn}__point #{bn}__point--#{d.message_type}"

    points
      .append 'line'
      .classed "#{bn}__bar", true
      .attr 'x1', 0
      .attr 'x2', 0
      .attr 'y1', 30
      .attr 'y2', 85

    points
      .append 'text'
      .classed "#{bn}__icon", true
      .style 'text-anchor', 'middle'
      .attr 'y', 100
      .html (d) =>
        icon = BeatmapDiscussionMessageType.icon[d.message_type]
        text = BeatmapDiscussionMessageType.iconText[d.message_type]

        "<tspan class='fa fa-#{icon}'>#{text}</tspan>"

    @svgPoints.exit().remove()

    @resize()


  setDimensions: =>
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)


  setScales: =>
    @scaleX
      .range [0, @width]


  setAxesSize: =>
    @xAxis
      .scale @scaleX


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawXAxis: =>
    @svgXAxis.attr 'width', @width


  positionPoints: =>
    @svgPoints
      .attr 'transform', (d) => "translate(#{Math.round(@scaleX(d.timestamp))}, 0)"



  resize: =>
    @setDimensions()

    @setScales()
    @setSvgSize()
    @setWrapperSize()
    @setAxesSize()

    @drawXAxis()
    @positionPoints()
