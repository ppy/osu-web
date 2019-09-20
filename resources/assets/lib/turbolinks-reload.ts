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

class @TurbolinksReload
  className = 'js-extra-script'

  constructor: ->
    @loaded = {}

    addEventListener 'turbolinks:before-cache', @unload


  load: (src, onload) =>
    return if @loaded[src]?

    el = document.createElement('script')
    el.classList.add className
    el.onload = ->
      # abort if the element has been removed (on navigation etc)
      return if !el.parentElement?

      el.parentElement.removeChild el
      onload?()
    el.src = src

    document.body.appendChild el

    @loaded[src] = true


  unload: =>
     document.body.removeChild(el) for el in document.querySelectorAll(".#{className}")
