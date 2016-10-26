###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

# For IE9.
# Reference: https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent
class @CustomEventPolyfill
  @fillIn: ->
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
