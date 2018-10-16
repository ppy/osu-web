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
  @breadcrumbsElement: ->
    document.getElementById('js-sticky-header-breadcrumbs')


  @contentElement: ->
    document.getElementById('js-sticky-header-content')


  @headerHeight: ->
    styles = window._styles.header
    if osu.isMobile()
      styles.heightMobile
    else
      styles.heightSticky


  constructor: ->
    @stickMarker = document.getElementsByClassName('js-sticky-header')
    @visible = false

    $(window).on 'throttled-scroll', @applyCss
    $(window).on 'throttled-scroll throttled-resize', @stickOrUnstick
    $(document).on 'turbolinks:load osu:page:change', @stickOrUnstick


  applyCss: ->
    header = document.getElementById('js-pinned-header')
    return unless header?

    styles = window._styles.header
    if window.pageYOffset > styles.height
      document.body.classList.add 'js-header-is-pinned'
    else
      document.body.classList.remove 'js-header-is-pinned'


  setVisible: (visible) ->
    return if @visible == visible

    @visible = visible
    if visible
      Fade.in document.getElementById('js-sticky-header')
    else
      Fade.out document.getElementById('js-sticky-header')


  stickOrUnstick: =>
    return if @stickMarker.length == 0
    markerTop = @stickMarker[0].getBoundingClientRect().top
    headerBottom = document.getElementById('js-pinned-header').getBoundingClientRect().bottom

    @setVisible markerTop < headerBottom
