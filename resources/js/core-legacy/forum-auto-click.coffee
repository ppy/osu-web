# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class ForumAutoClick
  constructor: ->
    @_triggerDistance = 1200
    @throttledOnScroll = _.throttle @onScroll, 1000

    $(document).on 'turbolinks:load', @onLoad


  commonClick: (link) ->
    # abort if no more posts to load
    return if link.dataset.noMore == '1'
    # abort if link has previously failed loading
    return if link.dataset.failed == '1'
    # abort if link is invisible
    return if link.getBoundingClientRect().height == 0

    link.click()


  nextClick: =>
    return if !@nextLink?
    # abort if link is too far above the window
    return if @nextLink.getBoundingClientRect().top > document.documentElement.clientHeight + @_triggerDistance
    # proceed to common link auto click function
    @commonClick @nextLink


  onLoad: =>
    $.unsubscribe 'scroll', @throttledOnScroll
    $(window).off 'osu:page:change', @throttledOnScroll

    @nextLink = document.querySelector('.js-forum__posts-show-more--next')
    @previousLink = document.querySelector('.js-forum__posts-show-more--previous')

    if @nextLink? && @previousLink?
      @throttledOnScroll()
      $(window).on 'scroll', @throttledOnScroll
      $.subscribe 'osu:page:change', @throttledOnScroll


  onScroll: =>
    @previousClick()
    @nextClick()


  previousClick: =>
    return if !@previousLink?
    # abort if link is too far above the window
    return if @previousLink.getBoundingClientRect().top < -@_triggerDistance
    # proceed to common link auto click function
    @commonClick @previousLink
