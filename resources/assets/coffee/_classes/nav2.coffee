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

class @Nav2
  constructor: ->
    addEventListener 'turbolinks:load', @setLoginBoxElements
    $.subscribe 'click-menu:current', @autoCenterPopup
    $(window).on 'throttled-resize, throttled-scroll', @stickLogin


  autoCenterPopup: (_e, currentMenu) =>
    @currentMenu = currentMenu

    $(window).off 'throttled-resize.nav2-center-popup'

    for popup in document.querySelectorAll('.js-nav2--centered-popup')
      continue if popup.dataset.clickMenuId != @currentMenu

      currentPopup = popup
      link = document.querySelector(".js-click-menu[data-click-menu-target='#{@currentMenu}'")

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
    bodyRect = document.body.getBoundingClientRect()

    referenceHalfWidth = referenceRect.width / 2
    popupHalfWidth = popupRect.width / 2
    popupLeft = popupContainerRect.left

    popupLeftForCentered = referenceRect.left + referenceHalfWidth - popupLeft - popupHalfWidth
    popupLeftWhenCentered = popupLeft + popupLeftForCentered

    if popupLeftWhenCentered < 0
      finalLeft = Math.floor(referenceRect.left) * -1
    else
      popupRightWhenCentered = popupLeftWhenCentered + popupRect.width
      popupRightOverflow = Math.round(popupRightWhenCentered - bodyRect.width)

      finalLeft =
        if popupRightOverflow > 0
          popupLeftForCentered - popupRightOverflow
        else
          popupLeftForCentered

    popup.style.transform = "translateX(#{finalLeft}px)"


  loginBoxVisible: =>
    @currentMenu == 'nav2-login-box'


  stickLogin: (_e, target) =>
    return unless @loginBoxVisible()

    @loginBox.style.position =
      if @loginPopupReference.getBoundingClientRect().top < 0
        'fixed'
      else
        ''


  setLoginBoxElements: =>
    @loginPopupReference = document.querySelector('.js-nav2--login-box-reference')
    @loginBox = document.querySelector('.js-nav2--login-box')
