###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

# Attachment that shows up below the omni-header.
# How to use:
# 1. render content into 'js-sticky-header-content' and 'js-sticky-header-breadcrumbs'
# 2. Add 'js-sticky-header' class to a marker element that should cause the sticky to show.
class @StickyHeader
  constructor: ->
    @header = document.getElementsByClassName('js-pinned-header')
    @marker = document.getElementsByClassName('js-sticky-header')
    @pinnedSticky = document.getElementsByClassName('js-pinned-header-sticky')
    @stickyBreadcrumbs = document.getElementsByClassName('js-sticky-header-breadcrumbs')
    @stickyContent = document.getElementsByClassName('js-sticky-header-content')

    $(window).on 'throttled-scroll', @onScroll
    $(document).on 'turbolinks:load osu:page:change', => Timeout.set 0, @onScroll
    $(window).on 'throttled-resize', @stickOrUnstick


  breadcrumbsElement: ->
    @stickyBreadcrumbs[0]


  contentElement: ->
    @stickyContent[0]


  headerHeight: ->
    styles = window._styles.header
    if osu.isMobile()
      styles.heightMobile
    else
      styles.heightSticky


  onScroll: =>
    @pin()
    @stickOrUnstick()


  pin: =>
    return unless @header[0]?

    if @shouldPin()
      document.body.classList.add 'js-header-is-pinned'
    else
      document.body.classList.remove 'js-header-is-pinned'


  scrollOffset: (orig) ->
    # just assume scroll will always try to go to a position that causes sticky to show.
    # TODO: don't assume.
    stickyHeight = if @pinnedSticky[0]? then @pinnedSticky[0].getBoundingClientRect().height else 0
    Math.max(0, orig - @headerHeight() - stickyHeight)


  setVisible: (visible) =>
    Fade.toggle @pinnedSticky[0], visible

    $(document).trigger 'sticky-header:sticking', [visible]


  shouldPin: (offset = window.pageYOffset) =>
    offset > window._styles.header.height || @shouldStick()


  shouldStick: =>
    return unless @marker.length > 0 && @pinnedSticky[0]?
    markerTop = @marker[0].getBoundingClientRect().top
    headerBottom = @headerHeight() + @pinnedSticky[0].getBoundingClientRect().height

    markerTop < headerBottom


  stickOrUnstick: =>
    visible = @shouldStick() # undefined when elements don't exist
    return unless visible?

    @setVisible visible
