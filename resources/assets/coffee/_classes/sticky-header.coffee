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

    $(window).on 'throttled-scroll', @pin
    $(window).on 'throttled-scroll throttled-resize', @stickOrUnstick
    $(document).on 'turbolinks:load osu:page:change', @stickOrUnstick


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
