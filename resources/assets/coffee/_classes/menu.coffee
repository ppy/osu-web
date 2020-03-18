# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @Menu
  constructor: ->
    @menuTimeout = 150

    $(document).on 'touchstart', '.js-menu', @onTouchStart
    $(document).on 'mouseenter', '.js-menu', @onMouseEnter
    $(document).on 'mouseleave', '.js-menu', @onMouseLeave
    $(document).on 'touchstart', @onGlobalTouchstart
    $(document).on 'turbolinks:load', @refresh


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


  onGlobalTouchstart: (e) =>
    return unless @currentMenu

    closest = e.target
    while closest
      return if closest.classList.contains('js-menu')
      closest = closest.parentElement

    @hideMenu()


  onTouchStart: (e) =>
    link = e.currentTarget
    target = link.dataset.menuTarget

    return unless target?

    $target = $(target)
    e.preventDefault()
    timeout = parseInt(link.dataset.menuShowDelay ? @menuTimeout, 10)

    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set timeout, =>
      @currentMenu =
        if @currentMenu == target
          @closestMenuId $target
        else
          target
      @refresh()



  onMouseEnter: (e) =>
    link = e.currentTarget
    timeout = parseInt(link.dataset.menuShowDelay ? @menuTimeout, 10)

    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set timeout, =>
      @currentMenu = link.dataset.menuTarget
      @currentMenu ?= @closestMenuId $(link)
      @refresh()



  onMouseLeave: (e) =>
    $target = $(e.currentTarget)

    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set @menuTimeout, =>
      @currentMenu = @parentsMenuId $target
      @refresh()


  hideMenu: =>
    Timeout.clear @refreshTimeout
    @refreshTimeout = Timeout.set @menuTimeout, =>
      @currentMenu = null
      @refresh()


  refresh: =>
    @currentMenu ?= @defaultMenu()
    menus = document.querySelectorAll('.js-menu[data-menu-id]')

    currentTree = @currentTree()
    $.publish 'menu:current', @currentMenu

    for menu in menus
      menuId = menu.getAttribute('data-menu-id')

      if currentTree.indexOf(menuId) == -1
        Fade.out menu
        @$menuLink(menuId).removeClass('js-menu--active')
      else
        Fade.in menu
        @$menuLink(menuId).addClass('js-menu--active')
        $(menu).trigger 'menu:showing'
