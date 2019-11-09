###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

class @Nav2
  constructor: ->
    @menuBg = document.getElementsByClassName('js-nav2--menu-bg')

    $.subscribe 'click-menu:current', @autoCenterPopup
    $.subscribe 'menu:current', @showMenuBg


  autoCenterPopup: (_e, currentMenu) =>
    @currentMenu = currentMenu

    $(window).off 'throttled-resize.nav2-center-popup'

    for popup in document.querySelectorAll('.js-nav2--centered-popup')
      if popup.dataset.clickMenuId != @currentMenu
        popup.classList.add 'hidden'
        continue

      popup.classList.remove 'hidden'
      currentPopup = popup
      link = document.querySelector(".js-click-menu[data-click-menu-target='#{@currentMenu}']")

    return if !currentPopup?

    doCenter = =>
      @centerPopup currentPopup, link

    $(window).on 'throttled-resize.nav2-center-popup', doCenter
    osu.pageChangeImmediate() if @loginBoxVisible()
    doCenter()
    currentPopup.querySelector('.js-nav2--autofocus')?.focus()


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

    Fade.toggle @menuBg[0], shown
