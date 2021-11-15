# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.FancyGraph
  container: document.getElementsByClassName('js-fancy-graph')


  constructor: ->
    $(window).on 'resize', @resize
    $(document).on 'turbolinks:load', @initialize


  initialize: =>
    return if !@container[0]?

    @container[0]._chart ?= new FancyChart @container[0]


  resize: =>
    return if !@container[0]?

    @container[0]._chart?.resize()
