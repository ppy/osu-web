###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

class @UserLogin


  constructor: ->
    # Used as callback on original action (where login was required)
    @clickAfterLogin = null

    $(document).on 'ajax:success', '.js-login-form', @loginSuccess
    $(document).on 'ajax:error', '.js-login-form', @loginError
    $(document).on 'submit', '.js-login-form', @clearError
    $(document).on 'input', '.js-login-form-input', @clearError

    $(document).on 'click', '.js-user-link', @showOnClick
    $(document).on 'click', '.js-login-required--click', @showToContinue
    $(document).on 'ajax:before', '.js-login-required--click', -> currentUser.id?

    $(document).on 'ajax:error', @showOnError
    $(document).on 'turbolinks:load', @showOnLoad
    $.subscribe 'nav:popup:hidden', @reset


  clearError: (_e) ->
    $('.js-login-form--error').text('')


  loginError: (e, xhr) =>
    e.preventDefault()
    e.stopPropagation()
    $('.js-login-form--error').text(osu.xhrErrorMessage(xhr))


  loginSuccess: (_event, data) =>
    toClick = @clickAfterLogin
    @clickAfterLogin = null

    @refreshToken()

    $.publish 'user:update', data.user

    # To allow other ajax:* events attached to header menu
    # to be triggered before the element is removed.
    Timeout.set 0, =>
      $('.js-user-login--menu')[0]?.click()
      $('.js-user-header').replaceWith data.header
      $('.js-user-header-popup').html data.header_popup

      osu.executeAction toClick


  refreshToken: =>
    token = Cookies.get('XSRF-TOKEN')
    $('[name="_token"]').attr 'value', token
    $('[name="csrf-token"]').attr 'content', token


  reset: =>
    @clickAfterLogin = null


  show: (target) =>
    @clickAfterLogin = target

    Timeout.set 0, ->
      $(document).trigger 'gallery:close'
      $('.js-user-login--menu')[0].click()


  showOnClick: (e) =>
    e.preventDefault()
    @show()


  showOnError: (e, xhr) =>
    return false unless xhr.status == 401 && xhr.responseJSON?.authentication == 'basic'

    if currentUser.id?
      # broken page state
      osu.reloadPage()
    else
      @show e.target

    true


  # for pages which require authentication
  # and being visited directly from outside
  showOnLoad: =>
      return unless window.showLoginModal?

      window.showLoginModal = null
      @show()


  showToContinue: (e) =>
    return if currentUser.id?
    e.preventDefault()
    Timeout.set 0, => @show e.target
