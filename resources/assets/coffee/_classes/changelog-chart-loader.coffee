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

    parsedData = []

    # normalize the user count values
    # and parse data into a form digestible by d3.stack()
    for own timestamp, values of data
      sum = 0

      for val in values
        sum += val.user_count

      for val in values
        val.normalized = val.user_count / sum

      obj =
        created_at: timestamp

      for val in values
        obj[val.label] = val

      parsedData.push obj

    stack = d3.stack()
      .keys order
      .value (d, val) ->
        if d[val]? then d[val].normalized else 0

    parsedData = stack parsedData

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
