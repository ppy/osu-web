###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

class @Fade
  constructor: ->
    $(document).on 'transitionend', '.js-fade--out', @outComplete
    $(document).on 'transitionend', '.js-fade--in', @inComplete


  out: (el, callback) ->
    el.style.opacity = '0'
    el.classList.add 'js-fade--out'
    el._js_fade_out_callback = callback


  outComplete: (e) ->
      target = e.target
      return unless getComputedStyle(target).opacity == '0'

      target.classList.remove 'js-fade--out'
      target.style.display = 'none'
      if target._js_fade_out_callback
        target._js_fade_out_callback()
        target._js_fade_out_callback = null


  in: (el, display = 'block', callback) ->
    el.style.display = display
    el.classList.add 'js-fade--in'
    el._js_fade_in_callback = callback

    show = -> el.style.opacity = '1'
    setTimeout show, 0


  inComplete: (e) ->
      target = e.target
      return unless getComputedStyle(target).opacity == '1'

      target.classList.remove 'js-fade--in'
      if target._js_fade_in_callback
        target._js_fade_in_callback()
        target._js_fade_in_callback = null
