# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @ThrottledWindowEvents
  throttle: (eventName) ->
    running = false
    func = ->
      return if running

      running = true

      requestAnimationFrame ->
        window.dispatchEvent(new CustomEvent("throttled-#{eventName}"))
        running = false

    window.addEventListener eventName, func

  constructor: ->
    @throttle('resize')
    @throttle('scroll')
