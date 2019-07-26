###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

class @Polyfills
  constructor: ->
    @customEvent()
    @localStorage()
    @mathTrunc()
    @composedPath()


  # Event.composedPath polyfill for Edge.
  # Actual composedPath logic is a bit more complicated but this works for our usage
  # until it gets implemented in Edge.
  composedPath: ->
    return if typeof Event.prototype.composedPath == 'function'

    Event.prototype.composedPath = ->
      target = @target
      path = []
      while target.parentNode?
        path.push target
        target = target.parentNode

      path.push document, window

      return path


  # For IE9+.
  # Reference: https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent
  customEvent: ->
    return if typeof CustomEvent == 'function'

    customEvent = (event, params) ->
      params ?=
        bubbles: false
        cancelable: false
        detail: undefined

      evt = document.createEvent 'CustomEvent'
      evt.initCustomEvent event, params.bubbles, params.cancelable, params.detail

      evt

    customEvent.prototype = window.Event.prototype

    window.CustomEvent = customEvent


  # Mainly for Safari Private Mode.
  localStorage: ->
    try
      window.localStorage.setItem '_test', '1'
      window.localStorage.removeItem '_test'
    catch
      localStorage = new DumbStorage
      window.localStorage = localStorage
      window.localStorage.__proto__ = localStorage


  # For IE.
  # Reference: https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Math/trunc
  mathTrunc: ->
    Math.trunc ?= (x) ->
      x - x % 1
