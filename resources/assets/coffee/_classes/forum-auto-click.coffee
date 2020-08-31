# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @ForumAutoClick
  constructor: ->
    @_triggerDistance = 1200
    @nextLink = document.getElementsByClassName('js-forum__posts-show-more--next')
    @previousLink = document.getElementsByClassName('js-forum__posts-show-more--previous')
    @throttledOnScroll = _.throttle @onScroll, 1000

    $(window).on 'scroll', @throttledOnScroll
    $(document).on 'turbolinks:load', @throttledOnScroll
    $.subscribe 'osu:page:change', @throttledOnScroll


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
