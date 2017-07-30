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

class @ChangelogChart
  constructor: (area, @options = {}) ->
    @options.scales ?= {}
    @options.scales.x ?= d3.scaleLinear()
    @options.scales.y ?= d3.scaleLinear()

    @margins =
      top: 0
      right: 0
      bottom: 0
      left: 0

    @area = d3.select area

    @svg = @area
      .append 'svg'

    @svgWrapper = @svg
      .append 'g'

    @areaFunction = d3.area()
      .curve d3.curveMonotoneX
      .x (d, i) => @options.scales.x i
      .y1 (d) => @options.scales.y d.normalized
      .y0 (d, i) => @options.scales.y d.baseline

    @svgLines = {}

    for el in @options.order
      @svgLines[el] = @svgWrapper.append 'path'
        .classed "changelog-chart__area changelog-chart__area--#{_.kebabCase el}", true

    @hoverArea = @svg.append 'rect'
      .classed 'changelog-chart__hover-area', true
      .on 'mouseout', @hideTooltip
      .on 'mousemove', @positionTooltip

    @tooltipArea = @area.append 'div'
      .classed 'changelog-chart__tooltip-area', true

    @tooltipContainer = @tooltipArea.append 'div'
      .classed 'changelog-chart__tooltip-container', true
      .attr 'data-visibility', 'hidden'

    @lineTop = @tooltipContainer.append 'div'
      .classed 'changelog-chart__tooltip-line', true

    @tooltip = @tooltipContainer.append 'div'
      .classed 'changelog-chart__tooltip', true

    @tooltipName = @tooltip.append 'div'

    @tooltipUserCount = @tooltip.append 'div'
      .classed 'changelog-chart__text changelog-chart__text--user-count', true

    @tooltipDate = @tooltip.append 'div'
      .classed 'changelog-chart__text changelog-chart__text--date', true

    @lineBottom = @tooltipContainer.append 'div'
      .classed 'changelog-chart__tooltip-line', true

  loadData: (data) ->
    @data = data

    for el in @options.order
      @svgLines[el].datum @data[el]

    @resize()

  setDimensions: ->
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)

  setSvgSize: ->
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)

  setWrapperSize: ->
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"

  setHoverAreaSize: ->
    @hoverArea
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)

  setScalesRange: ->
    @options.scales.x
      .range [0, @width]
      .domain [0, @data[_.first @options.order].length - 1]

    @options.scales.y
      .range [0, @height]
      .domain [0, 1]

  setLineSize: ->
    for el in @options.order
      @svgLines[el]
       .attr 'd', @areaFunction

  showTooltip: =>
    Fade.in @tooltipContainer.node()

  hideTooltip: =>
    Fade.out @tooltipContainer.node()

  positionTooltip: =>
    mousePos = d3.mouse @hoverArea.node()
    x = Math.round @options.scales.x.invert mousePos[0]
    y = mousePos[1] / @height

    for el in @options.order
      if y <= @data[el][x].normalized
        currentStream = el

    @showTooltip()

    Timeout.clear @_autoHideTooltip
    @_autoHideTooltip = Timeout.set 3000, @hideTooltip

    coord = @options.scales.x(x) + @margins.left

    @tooltipName
      .attr 'class', "changelog-chart__text changelog-chart__text--name changelog-chart__text--#{_.kebabCase currentStream}"
      .text currentStream
    @tooltipUserCount.text @data[currentStream][x].user_count
    @tooltipDate.html @getDate @data[currentStream][x].created_at
    @tooltipContainer
      .style 'transform', "translate(#{coord}px) translateX(-50%)"

  getDate: (date) ->
    @dateStorage ?= {}

    if !@dateStorage[date]?
      @dateStorage[date] = moment(date).format 'YYYY/MM/DD'

    @dateStorage[date]

  resize: =>
    @setDimensions()
    @setScalesRange()
    @setSvgSize()
    @setWrapperSize()
    @setLineSize()
    @setHoverAreaSize()
