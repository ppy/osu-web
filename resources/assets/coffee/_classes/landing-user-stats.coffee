# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.LandingUserStats
  constructor: ->
    # Define constants
    @margin =
      top: 40
      right: 0
      bottom: 0
      left: 0

    # radius for peak circle
    @peakR = 5

    # Define basic elements
    @svgContainerOuter = d3
      .select '.js-landing-graph'

    # Clear out previously set graphs
    @svgContainerOuter.selectAll('svg').remove()

    @svgContainerInner = @svgContainerOuter
      .append 'svg'
      .attr 'class', 'landing-graph'

    @svg = @svgContainerInner
      .append 'g'
      # Ensure no blank space at the bottom at certain zoom level in Firefox.
      .attr 'transform', "translate(#{@margin.left}, #{@margin.top + 1})"

    @svgArea = @svg
      .append 'path'
      .attr 'class', 'landing-graph__area'

    @svgPeakText = @svg
      .append 'text'
      .attr 'class', 'landing-graph__text'
      .attr 'y', (-@peakR * 2)

    @svgPeakCircle = @svg
      .append 'circle'
      .attr 'class', 'landing-graph__circle'
      .attr 'cy', 0
      .attr 'r', @peakR

    @scaleX = d3.scaleLinear()
    @scaleY = d3.scaleTime()

    @area = d3.area()
      .curve(d3.curveBasis)
      .x (d) =>
        @scaleX d.x
      .y0 =>
        @height
      .y1 (d) =>
        @scaleY d.y

    # Load initial data
    @loadData()

    # Render
    @resize()


  loadData: =>
    @data = _exported.parseJson('json-stats')

    return if _.isEmpty(@data)

    @maxElem = _.maxBy @data, (o) -> o.y

    @scaleX.domain d3.extent(@data, (d) -> d.x)
    @scaleY.domain [0, d3.max(@data, (d) -> d.y)]

    @svgPeakText
      .text osu.trans('home.landing.peak', count: osu.formatNumber(@maxElem.y))
    @peakTextLength = @svgPeakText.node().getComputedTextLength()


  resize: =>
    return if _.isEmpty(@data)

    # set basic dimensions
    @width = parseInt(@svgContainerOuter.style('width')) - @margin.left - @margin.right
    @height = parseInt(@svgContainerOuter.style('height')) - @margin.top - @margin.bottom

    # set range of scales
    @scaleX.range [0, @width]
    @scaleY.range [@height, 0]

    # resize svgContainerInner
    @svgContainerInner
      .attr 'width', @width + @margin.left + @margin.right
      .attr 'height', @height + @margin.top + @margin.bottom

    # resize svgArea
    @svgArea
      .datum @data
      .attr 'd', @area

    # reposition peak circle...
    @svgPeakCircle.attr 'cx', @scaleX(@maxElem.x)

    # ...and its label
    @svgPeakText.attr 'x', =>
      rightX = @scaleX(@maxElem.x) + (@peakR * 2)
      if (@peakTextLength + rightX) > @width
        @scaleX(@maxElem.x) - (@peakTextLength + (@peakR * 2))
      else
        rightX
