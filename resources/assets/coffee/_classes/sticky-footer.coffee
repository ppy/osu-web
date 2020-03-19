# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# How to use:
# 1. create a marker on when it should be fixed, with class including
#    'js-sticky-footer' and data attribute 'data-sticky-footer-target'
# 2. subscribe to 'stickyFooter' event
# 3. in the function, check if second parameter (first one is unused event
#    object) is the correct target
# 4. stick if matches, unstick otherwise
class @StickyFooter
  constructor: ->
    @stickMarker = document.getElementsByClassName('js-sticky-footer')
    @permanentFixedFooter = document.getElementsByClassName('js-permanent-fixed-footer')

    $(window).on 'throttled-scroll throttled-resize', @stickOrUnstick
    $.subscribe 'stickyFooter:check', @stickOrUnstick
    $(document).on 'turbolinks:load osu:page:change', @stickOrUnstick


  stickOrUnstick: =>
    return if @stickMarker.length == 0

    bottom = window.innerHeight - @permanentFixedFooter[0].offsetHeight

    for marker in @stickMarker
      continue if marker.getAttribute('data-sticky-footer-disabled') == '1'

      if marker.getBoundingClientRect().top >= bottom
        $.publish 'stickyFooter', marker.getAttribute('data-sticky-footer-target')
        return

    $.publish 'stickyFooter'


  markerCheckEnabled: (el) ->
    el.getAttribute('data-sticky-footer-disabled') == '1'


  markerDisable: (el) ->
    el.setAttribute('data-sticky-footer-disabled', '1')


  markerEnable: (el) ->
    el.setAttribute('data-sticky-footer-disabled', '')
