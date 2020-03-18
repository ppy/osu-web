# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @Blackout
  @el: document.getElementsByClassName 'js-blackout'


  @hide: =>
    @toggle false


  @show: =>
    @toggle true


  @toggle: (state, opacity) =>
    el = @el[0]

    return if !el?

    opacity = null if !state || !opacity?
    el.style.opacity = opacity
    Fade.toggle(el, state)
