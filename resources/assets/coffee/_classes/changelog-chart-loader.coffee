###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

class @ChangelogChartLoader
  container: document.getElementsByClassName('js-changelog-chart')

  constructor: ->
    $(window).on 'throttled-resize', @resize
    $(document).on 'turbolinks:load', @initialize

  initialize: =>
    return if !@container[0]?

    @container[0]._chart = new ChangelogChart @container[0]
    @container[0]._chart.loadData()

  resize: =>
    @container[0]?._chart.resize()
