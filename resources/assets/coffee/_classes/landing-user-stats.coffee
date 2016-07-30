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
class @LandingUserStats
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

    @svgContainerInner = @svgContainerOuter.append 'svg'

    @svg = @svgContainerInner
      .append 'g'
      .attr 'transform', "translate(#{@margin.left}, #{@margin.top})"

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

    @scaleX = d3.scale.linear()
    @scaleY = d3.time.scale()

    @area = d3.svg.area()
      .interpolate('basis')
      .x (d) =>
        @scaleX d.date
      .y0 =>
        @height
      .y1 (d) =>
        @scaleY d.users_osu

    # Load initial data
    @loadData()

    # Render
    @resize()


  loadData: =>
    @data = osu.parseJson('json-stats')

    # Define date parser
    parseDate = d3.time.format('%Y-%m-%d %H:%M:%S').parse

    # Parsing data
    @data.forEach (d) ->
      d.date = parseDate(d.date)
      d.users_osu = +d.users_osu

    # Fill dummy data
    if @data.length == 0
      @data = [
        {
          date: moment().subtract(1, 'day').toDate()
          users_osu: 1
        }
        {
          date: new Date()
          users_osu: 2
        }
      ]

    # Find the date for the max, from the end backward
    @maxElem = null
    for d in @data by -1
      @maxElem = d if !@maxElem? || d.users_osu > @maxElem.users_osu

    @scaleX.domain d3.extent(@data, (d) -> d.date)
    @scaleY.domain [0, d3.max(@data, (d) -> d.users_osu)]

    @svgPeakText
      .text Lang.get('home.landing.peak', count: @maxElem.users_osu.toLocaleString())
    @peakTextLength = @svgPeakText.node().getComputedTextLength()


  resize: =>
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
    @svgPeakCircle.attr 'cx', @scaleX(@maxElem.date)

    # ...and its label
    @svgPeakText.attr 'x', =>
      rightX = @scaleX(@maxElem.date) + (@peakR * 2)
      if (@peakTextLength + rightX) > @width
        @scaleX(@maxElem.date) - (@peakTextLength + (@peakR * 2))
      else
        rightX
