# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { fadeIn, fadeOut } from 'utils/fade'
import { parseJson } from 'utils/json'

class window.ChangelogChart
  constructor: (area) ->
    @options =
      scales:
        x: d3.scaleTime()
        y: d3.scaleLinear()
        class: d3.scaleOrdinal()

    @area = d3.select area
    @area.classed 'changelog-chart', true

    @svg = @area
      .append 'svg'

    @svgWrapper = @svg
      .append 'g'

    @areaFunction = d3.area()
      .curve d3.curveMonotoneX
      .x (d) => @options.scales.x d.data.date
      .y1 (d) => @options.scales.y d[1]
      .y0 (d, i) => @options.scales.y d[0]

    @hoverArea = @svg.append 'rect'
      .classed 'changelog-chart__hover-area', true
      .on 'mouseout', @hideTooltip
      .on 'mousemove', @moveTooltip

    @tooltipArea = @area.append 'div'
      .classed 'changelog-chart__tooltip-area', true

    @tooltipContainer = @tooltipArea.append 'div'
      .classed 'changelog-chart__tooltip-container', true
      .attr 'data-visibility', 'hidden'

    @tooltipContainer.append 'div'
      .classed 'changelog-chart__tooltip-line', true

    @tooltip = @tooltipContainer.append 'div'
      .classed 'changelog-chart__tooltip', true

    @tooltipName = @tooltip.append 'div'

    @tooltipUserCount = @tooltip.append 'div'
      .classed 'changelog-chart__text changelog-chart__text--user-count', true

    @tooltipDate = @tooltip.append 'div'
      .classed 'changelog-chart__text changelog-chart__text--date', true

    @tooltipContainer.append 'div'
      .classed 'changelog-chart__tooltip-line', true

    @tooltipLine = @tooltipContainer.selectAll '.changelog-chart__tooltip-line'


  loadData: ->
    @config = parseJson 'json-chart-config'

    {data, hasData} = @normalizeData @config.build_history

    stack = d3.stack()
      .keys @config.order
      .value (d, val) ->
        if d[val]? then d[val].normalized else 0

    @data = stack data

    @hasData = @config.build_history? &&
      @config.build_history.length > 0 &&
      hasData


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
      .domain [_.first(@data[0])?.data.date, _.last(@data[0])?.data.date]

    @options.scales.y
      .range [0, @height]
      .domain [0, 1]

    @options.scales.class
      .range _.map @config.order, (d, i) =>
        # rotate over available build ids (0-6) when the amount of builds
        # exceeds the available amount of colors
        if @config.stream_name? then "#{@config.stream_name}-build-#{i % 7}" else _.kebabCase d
      .domain @config.order


  drawLines: ->
    @svgWrapper
      .selectAll 'g'
      .data @data
      .enter()
      .append 'path'
      .attr 'class', (d) => "changelog-chart__area changelog-chart__area--#{@options.scales.class d.key}"
      .attr 'd', @areaFunction


  showTooltip: =>
    fadeIn @tooltipContainer.node()


  hideTooltip: =>
    fadeOut @tooltipContainer.node()


  moveTooltip: (event) =>
    mousePos = d3.pointer event
    @x = @options.scales.x.invert mousePos[0]
    @y = mousePos[1] / @height

    @showTooltip()

    Timeout.clear @_autoHideTooltip
    @_autoHideTooltip = Timeout.set 3000, @hideTooltip

    @positionTooltip()


  positionTooltip: =>
    x = @x
    y = @y

    return unless x?

    pos = d3.bisector((d) -> d.data.date).left @data[0], x

    return unless pos?

    for el, i in @data
      if y <= el[pos][1] && el[pos].data[el.key]?
        dataRow = i
        currentLabel = el.key
        labelModifier = @options.scales.class currentLabel
        break

    coord = @options.scales.x x

    @tooltipName
      .attr 'class', "changelog-chart__text changelog-chart__text--name changelog-chart__text--#{labelModifier}"
      .text currentLabel
    @tooltipUserCount.text osu.formatNumber(@data[dataRow][pos].data[currentLabel].user_count)
    @tooltipDate.text @data[dataRow][pos].data.date_formatted

    tooltipWidth = @tooltip.node().getBoundingClientRect().width
    tooltipXBase = coord - (tooltipWidth / 2)

    # shift the toltip container when near to the left/right edge
    # of the chart, so that the tooltip doesn't extend outside of ito
    tooltipX =
      if tooltipXBase < 0
        0
      else if tooltipXBase + tooltipWidth > @width
        @width - tooltipWidth
      else
        tooltipXBase

    @tooltip
      .style 'transform', "translateX(#{tooltipX}px)"

    @tooltipLine
      .style 'transform', "translateX(#{coord}px)"


  resize: =>
    @area.classed 'hidden', !@hasData

    return if !@hasData

    @setDimensions()
    @setScalesRange()
    @setSvgSize()
    @setHoverAreaSize()
    @drawLines()
    @positionTooltip()



  normalizeData: (rawData) ->
    # normalize the user count values
    # and parse data into a form digestible by d3.stack()

    resetLabel = null
    hasData = null

    data =
      for own timestamp, values of _.groupBy rawData, 'created_at'
        sum = _.sumBy values, 'user_count'

        if sum == 0
          fakedVal = _.find(values, label: resetLabel) if resetLabel?
          unless fakedVal?
            fakedVal = _.last(values)
            resetLabel = fakedVal.label
          fakedVal.user_count = 1
          sum = 1
        else
          hasData ?= true

        # parse date stored in strings to JS Date object for use by
        # d3 domains, and format it into a string shown on the tooltip
        m = moment values[0].created_at

        obj =
          created_at: timestamp
          date: m.toDate()
          date_formatted: m.format 'YYYY/MM/DD'

        for val in values
          val.normalized = val.user_count / sum
          obj[val.label] = val

        obj

    {data, hasData}
