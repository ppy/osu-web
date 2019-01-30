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

class @ForumAutoClick
  constructor: ->
    @_triggerDistance = 1200
    @nextLink = document.getElementsByClassName('js-forum__posts-show-more--next')
    @previousLink = document.getElementsByClassName('js-forum__posts-show-more--previous')

    $(window).on 'throttled-scroll', _.throttle(@onScroll, 1000)

    $(document).on 'turbolinks:load osu:page:change', =>
      Timeout.set 1000, @onScroll


  commonClick: (link) ->
    # abort if link is invisible
    if link.getBoundingClientRect().height == 0
      return
    # abort if link has previously failed loading
    if link.getAttribute('data-failed') == '1'
      return
    link.click()

  nextClick: =>
    return if @nextLink.length == 0
    # abort if link is too far above the window
    return if @nextLink[0].getBoundingClientRect().top > document.documentElement.clientHeight + @_triggerDistance
    # proceed to common link auto click function
    @commonClick @nextLink[0]

  onScroll: =>
    @previousClick()
    @nextClick()

  previousClick: =>
    return if @previousLink.length == 0
    # abort if link is too far above the window
    return if @previousLink[0].getBoundingClientRect().top < -@_triggerDistance
    # proceed to common link auto click function
    @commonClick @previousLink[0]
