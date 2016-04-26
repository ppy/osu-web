###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License version 3
as published by the Free Software Foundation.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class UserDropdownModal
  box: document.getElementsByClassName('js-user-dropdown-modal__dialog')
  activeBox: document.getElementsByClassName('js-user-dropdown-modal__dialog--active')
  avatar: document.getElementsByClassName('js-nav-avatar')
  clickAfterLogin: null # Used as callback on original action (where login was required)


  constructor: ->
    $(window).on 'throttled-resize throttled-scroll', @reposition

    $(document).on 'show.bs.modal', '#user-dropdown-modal', @activate
    $(document).on 'hidden.bs.modal', '#user-dropdown-modal', @deactivate
    $(document).on 'ajax:success', '#login-form', @loginSuccess

    $(document).on 'click', '.js-login-required--click', (event) =>
      return if window.currentUser.id?
      event.preventDefault()
      @show event.target

    $(document).on 'ajax:error', (event, xhr) =>
      return unless xhr.status == 401
      @show event.target


  isAvatarVisible: =>
    @avatar[0].getBoundingClientRect().bottom > 0


  show: (target) =>
    $('#user-dropdown-modal').modal 'show'
    @clickAfterLogin = target

  hide: => 
    $('#user-dropdown-modal').modal 'hide'


  activate: =>
    @box[0].classList.add 'js-user-dropdown-modal__dialog--active'
    @reposition()


  deactivate: =>
    @box[0].classList.remove 'js-user-dropdown-modal__dialog--active'
    @clickAfterLogin = null


  reposition: =>
    return if !@activeBox[0]?

    if osu.isMobile()
      @box[0].classList.add 'js-user-dropdown-modal__dialog--centre'
      @box[0].style.marginTop = '60px'

    else if @isAvatarVisible()
      avatarDimensions = @avatar[0].getBoundingClientRect()
      normalTop = avatarDimensions.bottom + 20
      normalRight = window.innerWidth - avatarDimensions.right

      @box[0].classList.remove 'js-user-dropdown-modal__dialog--centre'
      @box[0].style.marginTop = "#{normalTop}px"
      @box[0].style.right = "#{normalRight}px"

    else
      @box[0].classList.add 'js-user-dropdown-modal__dialog--centre'
      @box[0].style.marginTop = '90px'


  loginSuccess: (_event, data) =>
    window.currentUser = data.data
    $(document).off '.ujsHideLoadingOverlay'
    LoadingOverlay.show()
    if @clickAfterLogin?
      if @clickAfterLogin.submit
        # plain javascript here doesn't trigger submit events
        # which means jquery-ujs handler won't be triggered
        # reference: https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit
        $(@clickAfterLogin).submit()
      else if @clickAfterLogin.click
        # inversely, using jquery here won't actually click the thing
        # reference: https://github.com/jquery/jquery/blob/f5aa89af7029ae6b9203c2d3e551a8554a0b4b89/src/event.js#L586
        @clickAfterLogin.click()
    else if window.reloadUrl
      url = window.reloadUrl
      window.reloadUrl = null
      Turbolinks.visit url
    else
      osu.reloadPage(null, true)

    @hide


window.userDropdownModal = new UserDropdownModal


# for pages which require authentication
# and being visited directly from outside
$(document).on 'ready turbolinks:load', ->
  return unless window.showLoginModal

  window.showLoginModal = null
  $('#user-dropdown-modal').modal backdrop: 'static'
