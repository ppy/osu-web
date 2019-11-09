###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

class @ClickMenu
  constructor: ->
    $(document).on 'click', '.js-click-menu', @toggle
    $(document).on 'click', @hide
    addEventListener 'turbolinks:load', @restoreSaved
    addEventListener 'turbolinks:before-cache', @saveCurrent


  hide: (e) =>
    return if e.button != 0
    return if osu.popupShowing()
    return if !@current?
    return if $(e.target).closest('.js-click-menu').length > 0

    @show()


  restoreSaved: =>
    @show document.body.dataset.clickMenuCurrent


  saveCurrent: =>
    document.body.dataset.clickMenuCurrent = @current


  show: (target) =>
    @current = null

    for menu in document.querySelectorAll('.js-click-menu[data-click-menu-id]')
      if menu.dataset.clickMenuId == target
        @current = target
        Fade.in menu
      else
        Fade.out menu

    for link in document.querySelectorAll('.js-click-menu[data-click-menu-target]')
      if @current? && link.dataset.clickMenuTarget == @current
        link.classList.add 'js-click-menu--active'
      else
        link.classList.remove 'js-click-menu--active'

    $.publish 'click-menu:current', @current


  toggle: (e) =>
    menu = e.currentTarget

    return if @current? && menu.dataset.clickMenuId == @current

    target = menu.dataset.clickMenuTarget
    next = target if @current != target
    e.preventDefault()

    @show next
