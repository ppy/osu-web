# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.Polyfills
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
