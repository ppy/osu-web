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

    config = osu.parseJson 'json-chart-config'
    order = config.order

    currentStream = osu.parseJson 'json-current-stream'

    data = osu.parseJson 'json-chart-data'
    data = _.groupBy data, 'created_at'

    parsedData = {}

    for el in order
      parsedData[el] = []

    console.log parsedData

    # group data points by label (stream name/version) while
    # adding points with user_count = 0 whenever there is no
    # data point for a given label
    for own timestamp, values of data
      points = _.keyBy values, 'label'

      for el in order
        if points[el]?
          parsedData[el].push points[el]
        else
          parsedData[el].push
            created_at: timestamp
            label: el
            user_count: 0

    # normalize the user count values so we can have a nice chart
    for point, i in parsedData[order[0]]
      sum = 0
      calc = 0

      for el in order
        sum += parsedData[el][i].user_count

      for el, j in order
        calc += parsedData[el][i].user_count
        parsedData[el][i].baseline = (calc - parsedData[el][i].user_count) / sum
        parsedData[el][i].normalized = calc / sum

    options =
      scales:
        x: d3.scaleLinear()
        y: d3.scaleLinear()
      order: _.reverse order
      isBuild: config.isBuild
      currentStream: currentStream

    @container[0]._chart = new ChangelogChart @container[0], options
    @container[0]._chart.loadData parsedData

  resize: =>
    @container[0]._chart?.resize()
