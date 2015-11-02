###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, version 3 of the License.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###

# How to use:
# 1. create a marker on when it should be fixed, with class including
#    'js-sticky-header' and data attribute 'data-sticky-header-target'
# 2. subscribe to 'stickyHeader' event
# 3. in the function, check if second parameter (first one is unused event
#    object) is the correct target
# 4. stick if matches, unstick otherwise
class @StickyHeader
  stickMarker: document.getElementsByClassName('js-sticky-header')

  constructor: ->
    $(window).on 'scroll', @stickOrUnstick
    $(document).on 'ready page:load osu:page:change', @stickOrUnstick

  stickOrUnstick: =>
    return if @stickMarker.length == 0

    for marker in @stickMarker by -1
      if marker.getBoundingClientRect().top < 0
        $.publish 'stickyHeader', marker.getAttribute('data-sticky-header-target')
        return

    $.publish 'stickyHeader'
