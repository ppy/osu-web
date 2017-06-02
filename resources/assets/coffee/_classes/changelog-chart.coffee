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

    @options.margins ?= {}
    @options.margins.top ?= 0
    @options.margins.right ?= 0
    @options.margins.bottom ?= 0
    @options.margins.left ?= 0

    @area = d3.select area

    @svg = @area
      .append 'svg'

    @svgWrapper = @svg
      .append 'g'

  loadData: (data) ->
    @data = data

    

    @resize()

  setDimensions: ->
    areaDims = @area.node().getBoundingClientRect()

    @width = areaDims.width - (@options.margins.left + @options.margins.right)
    @height = areaDims.height - (@options.margins.top + @options.margins.bottom)

  setSvgSize: ->
    @svg
      .attr 'width', @width + (@options.margins.left + @options.margins.right)
      .attr 'height', @height + (@options.margins.top + @options.margins.bottom)

  setWrapperSize: ->
    @svgWrapper
      .attr 'transform', "translate(#{@options.margins.left}, #{@options.margins.top})"

  setScalesRange: ->
    @options.scales.x
      .range []

  resize: =>
    @setDimensions()
    @setSvgSize()
    @setWrapperSize()
