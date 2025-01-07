# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ChangelogChart from 'charts/changelog-chart'

export default class ChangelogChartLoader
  constructor: ->
    $(window).on 'resize', @resize
    $(document).on 'turbo:load', @initialize


  initialize: =>
    @container = document.querySelector('.js-changelog-chart')

    return unless @container?

    # reset existing chart
    @container.innerHTML = ''

    @container._chart = new ChangelogChart @container
    @container._chart.loadData()


  resize: =>
    @container?._chart.resize()
