# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import LandingUserStats from 'charts/landing-user-stats'

export default class LandingGraph
  container: document.getElementsByClassName('js-landing-graph')


  constructor: ->
    $(window).on 'resize', @resize
    $(document).on 'turbolinks:load', @initialize


  initialize: =>
    return if !@container[0]?

    @container[0]._chart ?= new LandingUserStats


  resize: =>
    return if !@container[0]?

    @container[0]._chart?.resize()
