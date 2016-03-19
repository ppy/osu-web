###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class @SwitchableModePage extends React.Component
  setCurrentMode: (_e, mode) =>
    return if @state.currentMode == mode
    @setState currentMode: mode, @setHash

  setCurrentPage: (_e, page, callback) =>
    return if @state.currentPage == page
    @setState currentPage: page, =>
      callback() if callback
      @setHash()

  pages: document.getElementsByClassName("js-switchable-mode-page--scrollspy")
  pagesOffset: document.getElementsByClassName("js-switchable-mode-page--scrollspy-offset")

  pageScan: =>
    return if @scrolling
    return if @pages.length == 0

    anchorHeight = @pagesOffset[0].getBoundingClientRect().height

    if osu.bottomPage()
      @setCurrentPage null, _.last(@pages).dataset.pageId
      return

    for page in @pages
      pageDims = page.getBoundingClientRect()
      pageBottom = pageDims.bottom - Math.min(pageDims.height * 0.75, 200)
      continue unless pageBottom > anchorHeight

      @setCurrentPage null, page.dataset.pageId
      return

    @setCurrentPage null, page.dataset.pageId


  pageJump: (_e, page) =>
    if page == 'main'
      @setCurrentPage null, page
      return

    target = $(".js-switchable-mode-page--page[data-page-id='#{page}']")

    return unless target.length
    # Don't bother scanning the current position.
    # The result will be wrong when target page is too short anyway.
    @scrolling = true
    clearTimeout @timeouts.scrolling

    $(window).stop().scrollTo target, 500,
      onAfter: =>
        # Manually set the mode to avoid confusion (wrong highlight).
        # Scrolling will obviously break it but that's unfortunate result
        # from having the scrollspy marker at middle of page.
        @setCurrentPage null, page, =>
          # Doesn't work:
          # - part of state (callback, part of mode setting)
          # - simple variable in callback
          # Both still change the switch too soon.
          @timeouts.scrolling = setTimeout (=> @scrolling = false), 100
      # count for the tabs height
      offset: @pagesOffset[0].getBoundingClientRect().height * -1
