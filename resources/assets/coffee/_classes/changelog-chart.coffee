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
    @area = d3.select area

    @svg = @area
      .append 'svg'

    @svgWrapper = @svg
      .append 'g'

    @areaFunction = d3.area()
      .curve d3.curveMonotoneX
      .x (d, i) => @options.scales.x d.data.date
      .y1 (d) => @options.scales.y d[1]
      .y0 (d, i) => @options.scales.y d[0]

    @classScale = d3.scaleOrdinal (_.map @options.order, (d, i) =>
        if @options.isBuild then "build-#{i}" else _.kebabCase d)
      .domain(@options.order)

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
    data = @normalizeData _.groupBy data, 'created_at'

    stack = d3.stack()
      .keys @options.order
      .value (d, val) ->
        if d[val]? then d[val].normalized else 0

    @data = stack data

    @resize()

  setDimensions: ->
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width
    @height = areaDims.height

  setSvgSize: ->
    @svg
      .attr 'width', @width
      .attr 'height', @height

  setHoverAreaSize: ->
    @hoverArea
      .attr 'width', @width
      .attr 'height', @height

  setScalesRange: ->
    @options.scales.x
      .range [0, @width]
      .domain [_.first(@data[0]).data.date, _.last(@data[0]).data.date]

    @options.scales.y
      .range [0, @height]
      .domain [0, 1]

  drawLines: ->
    @svgWrapper
      .selectAll 'g'
      .data @data
      .enter()
      .append 'path'
      .attr 'class', (d) => "changelog-chart__area changelog-chart__area--#{@classScale d.key}"
      .attr 'd', @areaFunction

  showTooltip: =>
    Fade.in @tooltipContainer.node()

  hideTooltip: =>
    Fade.out @tooltipContainer.node()

  positionTooltip: =>
    mousePos = d3.mouse @hoverArea.node()
    x = @options.scales.x.invert mousePos[0]
    y = mousePos[1] / @height

    pos = d3.bisector((d) -> d.data.date).left @data[0], x

    return unless pos

    for el, i in @data
      if y <= el[pos][1]
        dataRow = i
        currentLabel = el.key
        labelModifier = @classScale currentLabel
        break

    @showTooltip()

    Timeout.clear @_autoHideTooltip
    @_autoHideTooltip = Timeout.set 3000, @hideTooltip

    coord = @options.scales.x x

    @tooltipName
      .attr 'class', "changelog-chart__text changelog-chart__text--name changelog-chart__text--#{labelModifier}"
      .text currentLabel
    @tooltipUserCount.text @data[dataRow][pos].data[currentLabel].user_count
    @tooltipDate.html @data[dataRow][pos].data.date_formatted

    tooltipWidth = @tooltip.node().getBoundingClientRect().width / 2

    # shift the tooltip container when near to the left/right edge
    # of the chart, so that the tooltip doesn't extend outside of it
    if coord < tooltipWidth
      translation = (-coord + tooltipWidth) / tooltipWidth * 50
    else if @width - coord < tooltipWidth
      translation = (@width - coord - tooltipWidth) / tooltipWidth * 50
    else
      translation = 0

    @tooltipContainer
      .style 'transform', "translate(#{coord}px) translateX(-#{50 - translation}%)"

    # shift the line guide so it keeps being in line with the tooltip
    @tooltipContainer.selectAll '.changelog-chart__tooltip-line'
      .style 'left', "#{-translation * tooltipWidth / 50}px"

  resize: =>
    @setDimensions()
    @setScalesRange()
    @setSvgSize()
    @setHoverAreaSize()
    @drawLines()

  normalizeData: (data) ->
    # normalize the user count values
    # and parse data into a form digestible by d3.stack()

    parsedData = for own timestamp, values of data
      sum = _.sumBy values, 'user_count'

      obj =
        created_at: timestamp
        date: values[0].date
        date_formatted: values[0].date_formatted

      for val in values
        val.normalized = val.user_count / sum
        obj[val.label] = val

      obj

    parsedData