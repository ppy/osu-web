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

class @NavButton
  constructor: ->
    @containers = document.getElementsByClassName 'js-nav-button--container'
    @items = document.getElementsByClassName 'js-nav-button--item'
    @main = document.getElementsByClassName 'js-nav-button'

    addEventListener 'turbolinks:load', @load


  load: =>
    if !@listening
      @listening = true
      $(window).on 'throttled-resize', @hideOrShow

    return if @main.length == 0

    # assumes:
    # - the width never changes once the page loads
    # - items all have same width
    @itemWidth = @items[0].offsetWidth
    @defaultWidth = 0
    @defaultWidth += c.offsetWidth for c in @containers

    @hideOrShow()


  hideOrShow: =>
    return if @main.length == 0

    currentMaxWidth = @main[0].offsetWidth
    currentWidth = @defaultWidth

    i.classList.remove 'hidden' for i in @items

    if currentMaxWidth < currentWidth
      for item in @items
        currentWidth -= @itemWidth
        item.classList.add 'hidden'

        return if currentMaxWidth >= currentWidth
