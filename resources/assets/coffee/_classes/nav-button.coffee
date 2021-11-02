# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.NavButton
  constructor: ->
    @containers = document.getElementsByClassName 'js-nav-button--container'
    @items = document.getElementsByClassName 'js-nav-button--item'
    @main = document.getElementsByClassName 'js-nav-button'

    addEventListener 'turbolinks:load', @load


  load: =>
    if !@listening
      @listening = true
      $(window).on 'resize', @hideOrShow

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
