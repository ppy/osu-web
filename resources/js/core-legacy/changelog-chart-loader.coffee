# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import ChangelogChart from 'charts/changelog-chart'

export default class ChangelogChartLoader
  constructor: ->
    document.addEventListener 'turbo:load', @initialize
    document.addEventListener 'turbo:before-cache', @reset


  initialize: =>
    container = document.querySelector('.js-changelog-chart')

    return unless container?

    # reset existing chart
    container.innerHTML = ''

    @chart = new ChangelogChart container
    @chart.loadData()
    window.addEventListener 'resize', @resize


  reset: =>
    @chart = null
    window.removeEventListener 'resize', @resize


  resize: =>
    @chart.resize()
