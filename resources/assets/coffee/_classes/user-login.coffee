# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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

    # Timeout here is to let ujs events fire first, so that the disabling of the submit button
    # in captcha.reset() happens _after_ the button has been re-enabled
    Timeout.set 0, =>
      captcha.trigger() if (xhr?.responseJSON?.captcha_triggered)
      captcha.reset()


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
      captcha.untrigger()

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
