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
class @UserVerification
  clickAfterVerification: null # Used as callback on original action (where verification was required)


  constructor: ->
    $(document).on 'ajax:error', @showOnError
    $(document).on 'ready turbolinks:load', @showOnLoad
    $(document).on 'keyup', '.js-user-verification--input', @autoSubmit

    @inputBox = document.getElementsByClassName('js-user-verification--input')
    @errorMessage = document.getElementsByClassName('js-user-verification--error')


  autoSubmit: (e) =>
    inputKey = e.currentTarget.value.replace /\s/g, ''
    lastKey = e.currentTarget.dataset.lastKey
    keyLength = parseInt(e.currentTarget.dataset.verificationKeyLength, 10)

    return if keyLength != inputKey.length
    return if inputKey == lastKey

    e.currentTarget.dataset.lastKey = inputKey

    $.post document.location.href,
      verification_key: inputKey
    .done @success
    .error @error



  error: (xhr) =>
    box = @errorMessage[0]
    Fade.in box
    box.textContent = osu.xhrErrorMessage xhr


  success: =>
    $('.js-user-verification').modal 'hide'

    toClick = @clickAfterVerification
    @clickAfterVerification = null
    Fade.out @errorMessage[0]
    @inputBox[0].value = 0
    @inputBox[0].dataset.lastKey = ''

    if toClick?
      if toClick.submit
        # plain javascript here doesn't trigger submit events
        # which means jquery-ujs handler won't be triggered
        # reference: https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit
        $(toClick).submit()
      else if toClick.click
        # inversely, using jquery here won't actually click the thing
        # reference: https://github.com/jquery/jquery/blob/f5aa89af7029ae6b9203c2d3e551a8554a0b4b89/src/event.js#L586
        toClick.click()
    else
      osu.reloadPage()


  show: (target, html) =>
    @clickAfterVerification = target

    if html?
      $('.js-user-verification--box').html html

    $('.js-user-verification')
    .modal static: true
    .modal 'show'


  showOnError: (e, xhr) =>
    return unless xhr.status == 401 && xhr.responseJSON?.authentication == 'verify'

    @show e.target, xhr.responseJSON.box


  # for pages which require authentication
  # and being visited directly from outside
  showOnLoad: =>
      return unless window.showVerificationModal

      window.showVerificationModal = null
      @show()
