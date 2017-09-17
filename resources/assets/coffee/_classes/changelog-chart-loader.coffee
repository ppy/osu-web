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

class @ChangelogChartLoader
  container: document.getElementsByClassName('js-changelog-chart')

  constructor: ->
    $(window).on 'throttled-resize', @resize
    $(document).on 'turbolinks:load', @initialize

  initialize: =>
    return if !@container[0]?

    chartConfig = osu.parseJson 'json-chart-config'
    data = chartConfig.buildHistory

    for el in data
      m = moment el.created_at

      el.date_formatted = m.format 'YYYY/MM/DD'
      el.date = m.toDate()

    options =
      scales:
        x: d3.scaleTime()
        y: d3.scaleLinear()
      order: chartConfig.order
      isBuild: chartConfig.isBuild

    @container[0]._chart = new ChangelogChart @container[0], options
    @container[0]._chart.loadData data

  resize: =>
    @container[0]?._chart.resize()
