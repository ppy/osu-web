# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

bn = 'line-chart'

class window.LineChart
  constructor: (area, @options = {}) ->
    @margins =
      top: 20
      right: 20
      bottom: 50
      left: 60

    _.assign @margins, @options.margins

    @id = Math.floor(Math.random() * 1000)
    @options.scales ?= {}
    @options.scales.x ?= d3.scaleTime()
    @options.scales.y ?= d3.scaleLinear()
    @options.circleLine ?= false
    @options.axisLabels ?= true

    @area = d3.select(area)
      .classed _exported.classWithModifiers(bn, @options.modifiers), true

    @svg = @area.append 'svg'

    @svgWrapper = @svg.append 'g'
      .classed "#{bn}__wrapper", true

    if @options.axisLabels
      @svgXAxis = @svgWrapper.append 'g'
        .classed "#{bn}__axis #{bn}__axis--x", true

      @svgYAxis = @svgWrapper.append 'g'
        .classed "#{bn}__axis #{bn}__axis--y", true

    @svgLine = @svgWrapper.append 'path'
      .classed "#{bn}__line", true

    @hoverArea = @area.append 'div'
      .classed "#{bn}__hover-area", true
      .on 'mouseout', @hoverEnd
      .on 'mousemove', @onHover
      .on 'drag', @onHover

    for own pos, size of @margins
      @hoverArea.style pos, "#{size}px"

    @hover = @hoverArea.append 'div'
      .classed "#{bn}__hover", true
      .attr 'data-visibility', 'hidden'

    if @options.circleLine
      @hoverLine = @hover.append 'div'
        .classed "#{bn}__hover-line", true

    @hoverCircle = @hover.append 'div'
      .classed "#{bn}__hover-circle", true

    @hoverInfoBox = @hover.append 'div'
      .classed "#{bn}__hover-info-box", true
      .attr 'data-float', 'left'

    @hoverInfoBoxX = @hoverInfoBox.append 'div'
      .classed "#{bn}__hover-info-box-text #{bn}__hover-info-box-text--x", true

    @hoverInfoBoxY = @hoverInfoBox.append 'div'
      .classed "#{bn}__hover-info-box-text #{bn}__hover-info-box-text--y", true

    if @options.axisLabels
      @xAxis = d3.axisBottom()
        .tickSizeOuter 0
        .tickPadding 5

      @yAxis = d3.axisLeft().ticks(4)

    @line = d3.line()
      .curve(@options.curve ? d3.curveMonotoneX)


  loadData: (data) =>
    @data = data
    @svgLine.datum data

    @resize()


  setDimensions: =>
    areaDims = @area.node().getBoundingClientRect()

    return false unless areaDims.width > 0 && areaDims.height > 0

    @width = areaDims.width - (@margins.left + @margins.right)
    @height = areaDims.height - (@margins.top + @margins.bottom)

    true


  setScalesRange: =>
    @options.scales.x
      .range [0, @width]
      .domain @options.domains?.x || d3.extent(@data, (d) => d.x)

    @options.scales.y
      .range [@height, 0]
      .domain @options.domains?.y || d3.extent(@data, (d) => d.y)


  setAxesSize: =>
    return unless @options.axisLabels

    @xAxis
      .scale @options.scales.x
      .tickSizeInner -@height
      .ticks @options.ticks?.x ? 15
      .tickFormat @options.formats.x
      .tickValues @options.tickValues?.x

    @yAxis
      .scale @options.scales.y
      .tickSizeInner -@width
      .tickFormat @options.formats.y
      .tickValues @options.tickValues?.y


  setLineSize: =>
    @line
      .x (d) => @options.scales.x d.x
      .y (d) => @options.scales.y d.y


  setSvgSize: =>
    @svg
      .attr 'width', @width + (@margins.left + @margins.right)
      .attr 'height', @height + (@margins.top + @margins.bottom)


  setWrapperSize: =>
    @svgWrapper
      .attr 'transform', "translate(#{@margins.left}, #{@margins.top})"


  drawAxes: =>
    return unless @options.axisLabels

    @svgXAxis
      .transition()
      .attr 'transform', "translate(0, #{@height})"
      .call @xAxis

    @svgYAxis
      .transition()
      .call @yAxis

    @svgXAxis.selectAll '.tick line'
      .classed "#{bn}__tick-line #{bn}__tick-line--default", true

    @svgYAxis.selectAll '.tick line'
      .classed "#{bn}__tick-line #{bn}__tick-line--default", true

    @svgXAxis.selectAll '.domain'
      .classed 'u-hidden', true

    @svgYAxis.selectAll '.domain'
      .classed 'u-hidden', true

    @svgXAxis.selectAll 'text'
      .style 'text-anchor', 'start'
      .attr 'transform', 'rotate(45) translate(5, 0)'
      .classed "#{bn}__tick-text #{bn}__tick-text--strong", true

    @svgYAxis.selectAll 'text'
      .classed "#{bn}__tick-text", true


  drawLine: =>
    @svgLine
      .transition()
      .attr 'd', @line


  hoverEnd: =>
    Fade.out @hover.node()


  hoverReset: =>
    style = (key, value) =>
      elem.style(key, value) for elem in [@hoverLine, @hoverCircle]
    # Immediately hide so its position can be invisibly reset.
    style 'transition', 'none'
    @hoverEnd()
    style 'transform', null
    # Out of current loop so browser doesn't optimize out the styling
    # and ignores previously set transition override.
    Timeout.set 0, => style 'transition', null


  hoverStart: =>
    Fade.in @hover.node()


  lookupIndexFromX: (x) =>
    d3.bisector((d) => d.x).left @data, x


  onHover: =>
    x = @options.scales.x.invert(d3.mouse(@hoverArea.node())[0])
    i = @lookupIndexFromX x

    return unless i
    return unless @data[i - 1] && @data[i]

    @hoverStart()
    Timeout.clear @_autoEndHover
    @_autoEndHover = Timeout.set(3000, @hoverEnd) if osuCore.windowSize.isMobile

    d = if x - @data[i - 1].x <= @data[i].x - x then @data[i - 1] else @data[i]
    coords = ['x', 'y'].map (axis) =>
      # rounded to avoid blurry positioning
      "#{Math.round(@options.scales[axis](d[axis]))}px"

    @hoverLine.style 'transform', "translateX(#{coords[0]})"
    @hoverCircle.style 'transform', "translate(#{coords.join(',')})"

    @hoverInfoBoxX.html (@options.infoBoxFormats?.x ? @options.formats.x)(d.x)
    @hoverInfoBoxY.html (@options.infoBoxFormats?.y ? @options.formats.y)(d.y)

    mouseX = d3.event.clientX

    if mouseX?
      infoBoxRect = @hoverInfoBox.node().getBoundingClientRect()
      if @hoverInfoBox.attr('data-float') == 'right'
        if mouseX > infoBoxRect.left
          @hoverInfoBox.attr('data-float', 'left')
      else
        if mouseX < infoBoxRect.right
          @hoverInfoBox.attr('data-float', 'right')


  resize: =>
    hasDimensions = @setDimensions()

    return unless hasDimensions

    @setScalesRange()

    @setSvgSize()
    @setWrapperSize()
    @setAxesSize()
    @setLineSize()

    @drawAxes()
    @drawLine()

    @hoverReset()
