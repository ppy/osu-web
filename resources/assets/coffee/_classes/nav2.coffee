# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { fadeToggle } from 'utils/fade'

class window.Nav2
  constructor: (@clickMenu) ->
    @menuBg = document.getElementsByClassName('js-nav2--menu-bg')

    $.subscribe 'click-menu:current', @autoCenterPopup
    $.subscribe 'click-menu:current', @autoMobileNav
    $.subscribe 'menu:current', @showMenuBg


  autoCenterPopup: (_e, {target}) =>
    @currentMenu = target

    $(window).off 'resize.nav2-center-popup'

    for popup in document.querySelectorAll('.js-nav2--centered-popup')
      container = popup.closest('.js-click-menu')

      continue if !container?

      if container.dataset.clickMenuId != @currentMenu
        popup.classList.add 'hidden'
        continue

      popup.classList.remove 'hidden'
      currentPopup = popup
      link = document.querySelector(".js-click-menu[data-click-menu-target='#{@currentMenu}']")

    return if !currentPopup?

    doCenter = =>
      @centerPopup currentPopup, link

    $(window).on 'resize.nav2-center-popup', doCenter
    _exported.pageChangeImmediate() if @loginBoxVisible()
    doCenter()
    currentPopup.querySelector('.js-nav2--autofocus')?.focus()


  autoMobileNav: (e, {previousTree, target, tree}) =>
    if target == 'mobile-menu'
      @clickMenu.show('mobile-nav')
      Timeout.set 0, => $(@clickMenu.menu('mobile-menu')).finish().slideDown(150)

    if tree.indexOf('mobile-menu') == -1
      if previousTree.indexOf('mobile-menu') != -1
        Blackout.hide()
        Timeout.set 0, => $(@clickMenu.menu('mobile-menu')).finish().slideUp(150)
    else
      Blackout.show()


  centerPopup: (popup, reference) ->
    popupRect = popup.getBoundingClientRect()
    popupContainerRect = popup.parentElement.getBoundingClientRect()
    referenceRect = reference.getBoundingClientRect()
    bodyWidth = document.body.getBoundingClientRect().width - 5 # some right margin, sync with .login-box@desktop

    referenceHalfWidth = referenceRect.width / 2
    popupHalfWidth = popupRect.width / 2
    popupLeft = popupContainerRect.left

    popupLeftForCentered = referenceRect.left + referenceHalfWidth - popupLeft - popupHalfWidth
    popupLeftWhenCentered = popupLeft + popupLeftForCentered

    finalLeft =
      if popupLeftWhenCentered < 0
        referenceRect.left * -1
      else
        popupRightWhenCentered = popupLeftWhenCentered + popupRect.width
        popupRightOverflow = Math.round(popupRightWhenCentered - bodyWidth)

        if popupRightOverflow > 0
          popupLeftForCentered - popupRightOverflow
        else
          popupLeftForCentered

    finalLeft = Math.floor(finalLeft)

    popup.style.transform = "translateX(#{finalLeft}px)"


  loginBoxVisible: =>
    @currentMenu == 'nav2-login-box'


  showMenuBg: (_e, currentMenu) =>
    shown = _.startsWith(currentMenu, 'nav2-menu-popup-')

    fadeToggle @menuBg[0], shown
