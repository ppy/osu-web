# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { fadeIn, fadeOut } from 'utils/fade'

export default class Menu
  constructor: ->
    @menuTimeout = 150

    $(document).on 'touchstart', '.js-menu', @onTouchStart
    $(document).on 'mouseenter', '.js-menu', @onMouseEnter
    $(document).on 'mouseleave', '.js-menu', @onMouseLeave
    $(document).on 'touchstart', @onGlobalTouchstart
    $(document).on 'turbolinks:load', @onDocumentReady


  $menuLink: (id) -> $(".js-menu[data-menu-target#{if id then "='#{id}'" else ''}]")


  closestMenuId: ($child) ->
    $child.closest('[data-menu-id]').attr('data-menu-id')

  defaultMenu: =>
    document.querySelector('.js-menu[data-menu-default="1"]')?.dataset?.menuTarget


  parentsMenuId: ($child) ->
    $child.parents('[data-menu-id]').attr('data-menu-id')


  currentTree: =>
    return [] unless @currentMenu

    traverseId = @currentMenu
    currentTree = [traverseId]

    while true
      traverseId = @closestMenuId @$menuLink(traverseId)

      if traverseId
        currentTree.push traverseId
      else
        break

    currentTree


  onDocumentReady: =>
    @refresh()
    # It seems like jQuery's mouseleave sometimes doesn't trigger on page navigation.
    # This will re-check whatever the mouse is currently pointing at.
    @setMenu null, => @closestMenuId($(':hover').last())


  onGlobalTouchstart: (e) =>
    return unless @currentMenu

    return if e.target.closest('.js-menu')?

    @hideMenu()


  onTouchStart: (e) =>
    link = e.currentTarget
    target = link.dataset.menuTarget

    return unless target?

    $target = $(target)
    e.preventDefault()
    timeout = parseInt(link.dataset.menuShowDelay ? @menuTimeout, 10)

    @setMenu timeout, =>
      if @currentMenu == target
        @closestMenuId $target
      else
        target



  onMouseEnter: (e) =>
    link = e.currentTarget
    timeout = parseInt(link.dataset.menuShowDelay ? @menuTimeout, 10)

    @setMenu timeout, =>
      link.dataset.menuTarget ? @closestMenuId($(link))


  onMouseLeave: (e) =>
    $target = $(e.currentTarget)

    @setMenu null, => @parentsMenuId($target)


  hideMenu: =>
    @setMenu()


  refresh: =>
    @currentMenu ?= @defaultMenu()
    menus = document.querySelectorAll('.js-menu[data-menu-id]')

    currentTree = @currentTree()
    $.publish 'menu:current', @currentMenu

    for menu in menus
      menuId = menu.getAttribute('data-menu-id')

      if currentTree.indexOf(menuId) == -1
        fadeOut menu
        @$menuLink(menuId).removeClass('js-menu--active')
      else
        fadeIn menu
        @$menuLink(menuId).addClass('js-menu--active')
        $(menu).trigger 'menu:showing'


  setMenu: (delay, menuFunc) =>
    delay ?= @menuTimeout
    Timeout.clear @refreshTimeout

    @refreshTimeout = Timeout.set delay, =>
      @currentMenu = menuFunc?()
      @refresh()
