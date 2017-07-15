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
    $(document).on 'throttled-resize', @resize
    $(document).on 'turbolinks:load', @initialize

  initialize: =>
    return if !@container[0]?

    streams = osu.parseJson 'json-update-streams'
    order = _.map streams, (d) ->
      d.update_stream.pretty_name

    data = osu.parseJson 'json-chart-data'
    data = _.groupBy data, 'pretty_name'

    # this assumes that all streams have an equal amount of data points
    for point, i in data[order[0]]
      sum = 0

      for el in order
        sum += data[el][i].user_count

      for el, j in order
        prev = if j == 0 then 0 else data[order[j - 1]][i].user_count
        data[el][i].user_count += prev
        data[el][i].normalized = (data[el][i].user_count) / sum

    options =
      scales:
        x: d3.scaleLinear()
        y: d3.scaleLinear()
      order: _.reverse order

    @container[0]._chart = new ChangelogChart @container[0], options
    @container[0]._chart.loadData data

  resize: =>
    @container[0]._chart?.resize()
