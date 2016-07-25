###
# Copyright 2015-2016 ppy Pty. Ltd.
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
class @UserLogin
  clickAfterLogin: null # Used as callback on original action (where login was required)


  constructor: (@nav) ->
    $(document).on 'ajax:success', '.js-login-form', @loginSuccess
    $(document).on 'ajax:error', '.js-login-form', @loginError

    $(document).on 'click', '.js-user-link', @showOnClick
    $(document).on 'click', '.js-login-required--click', @showToContinue

    $(document).on 'ajax:error', @showOnError
    $(document).on 'ready turbolinks:load', @showOnLoad


  hide: =>
    @nav.hidePopup()


  loginError: (e, xhr) =>
    e.preventDefault()
    e.stopPropagation()
    $('.js-login-form--error').text(osu.xhrErrorMessage(xhr))


  loginSuccess: (_event, data) =>
    $.publish 'user:update', data.data

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
    else
      osu.reloadPage()


  show: (target) =>
    @clickAfterLogin = target

    Timeout.clear @skipAnimationTimeout
    $('.js-nav-switch--menu').removeClass('js-nav-switch--animated')

    @nav.currentMode('user')
    @nav.showPopup()

    @skipAnimationTimeout = Timeout.set 100, =>
      $('.js-nav-switch--menu').addClass('js-nav-switch--animated')


  showOnClick: (event) =>
    event.preventDefault()
    Timeout.set 0, @show


  showOnError: (event, xhr) =>
    return unless xhr.status == 401
    @show event.target


  # for pages which require authentication
  # and being visited directly from outside
  showOnLoad: =>
      return unless window.showLoginModal?

      window.showLoginModal = null
      @show()


  showToContinue: (event) =>
    return if currentUser.id?
    event.preventDefault()
    Timeout.set 0, => @show event.target
