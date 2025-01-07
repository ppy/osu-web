# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ChangelogChart from 'charts/changelog-chart'

export default class ChangelogChartLoader
  container: document.getElementsByClassName('js-changelog-chart')

  constructor: ->
    $(window).on 'resize', @resize
    $(document).on 'turbo:load', @initialize


  initialize: =>
    container = @container[0]

    return unless container?

    # reset existing chart
    container.innerHTML = ''

    container._chart = new ChangelogChart container
    container._chart.loadData()


  resize: =>
    @container[0]?._chart.resize()
