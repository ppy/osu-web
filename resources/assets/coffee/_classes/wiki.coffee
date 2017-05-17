###
#    Copyright 2015-2017 ppy Pty. Ltd.
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


class @Wiki
  constructor: ->
    @floatTocContainer = document.getElementsByClassName('js-wiki-toc-float-container')
    @floatToc = document.getElementsByClassName('js-wiki-toc-float')

    $.subscribe 'stickyHeader', @stickyToc


  positionTocBottom: =>
    el = @floatToc[0]

    return if el._position == 'bottom'

    el._position = 'bottom'
    el.style.position = 'absolute'
    el.style.top = 'auto'
    el.style.bottom = 0
    el.style.width = 'auto'


  positionTocDefault: =>
    el = @floatToc[0]

    return if el._position == 'default'

    el._position = 'default'
    el.style.position = 'absolute'
    el.style.top = 0
    el.style.bottom = 'auto'
    el.style.width = 'auto'


  positionTocFloating: (containerRect) =>
    el = @floatToc[0]

    return if el._position == 'floating'

    el._position = 'floating'
    el.style.position = 'fixed'
    el.style.top = 0
    el.style.bottom = 'auto'
    el.style.width = "#{containerRect.width}px"


  stickyToc: (_e, target) =>
    return if !@floatToc[0]?

    # not floating
    return @positionTocDefault() if target != 'wiki-toc'

    containerRect = @floatTocContainer[0].getBoundingClientRect()
    rect = @floatToc[0].getBoundingClientRect()

    if rect.height > window.innerHeight
      # Toc longer than window, enforce default position
      @positionTocDefault()
    else
      if containerRect.bottom < rect.height
        # reached bottom
        @positionTocBottom()
      else
        # floating
        @positionTocFloating(containerRect)
