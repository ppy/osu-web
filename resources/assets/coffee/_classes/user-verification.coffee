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
  $modal: => $('.js-user-verification')


  clickAfterVerification: null # Used as callback on original action (where verification was required)


  constructor: (@nav) ->
    $(document).on 'ajax:error', @showOnError
    $(document).on 'ready turbolinks:load', @showOnLoad
    $(document).on 'keyup', '.js-user-verification--input', @autoSubmit

    $(window).on 'throttled-resize throttled-scroll', @reposition

    @inputBox = document.getElementsByClassName('js-user-verification--input')
    @errorMessage = document.getElementsByClassName('js-user-verification--error')
    @modal = document.getElementsByClassName('js-user-verification')
    @reference = document.getElementsByClassName('js-user-verification--reference')


  autoSubmit: (e) =>
    verifying = document.getElementsByClassName('js-user-verification--verifying')[0]
    target = @inputBox[0]
    inputKey = target.value.replace /\s/g, ''
    lastKey = target.dataset.lastKey
    keyLength = parseInt(target.dataset.verificationKeyLength, 10)

    if keyLength == 0
      Fade.out target

    return if keyLength != inputKey.length
    return if inputKey == lastKey

    target.dataset.lastKey = inputKey

    @request?.abort()
    Fade.in verifying
    Fade.out @errorMessage[0]

    @request =
      $.post laroute.route('account.verify'),
        verification_key: inputKey
      .done @success
      .error @error
      .always =>
        Fade.out verifying


  error: (xhr) =>
    box = @errorMessage[0]
    Fade.in box
    box.textContent = osu.xhrErrorMessage xhr


  float: (float, modal = @modal[0], referenceBottom) =>
    if float
      modal.classList.add 'js-user-verification--center'
      modal.style.paddingTop = null
    else
      modal.classList.remove 'js-user-verification--center'
      modal.style.paddingTop = "#{referenceBottom}px"


  reposition: =>
    modal = @modal[0]

    return unless modal?.classList.contains('js-user-verification--active')

    if osu.isMobile()
      @float(true, modal)
    else
      referenceBottom = @reference[0]?.getBoundingClientRect().bottom

      @float(referenceBottom < 0, modal, referenceBottom)


  success: =>
    @$modal().modal 'hide'
    @modal[0].classList.remove('js-user-verification--active')

    toClick = @clickAfterVerification
    @clickAfterVerification = null
    Fade.out @errorMessage[0]
    @inputBox[0].value = ''
    @inputBox[0].dataset.lastKey = ''

    osu.executeAction toClick


  show: (target, html) =>
    Timeout.set 0, => @nav.hidePopup()

    @clickAfterVerification = target

    if html?
      $('.js-user-verification--box').html html

    @$modal()
    .modal backdrop: 'static'
    .modal 'show'
    .addClass 'js-user-verification--active'

    @reposition()


  showOnError: ({target}, xhr) =>
    return unless xhr.status == 401 && xhr.responseJSON?.authentication == 'verify'

    @show target, xhr.responseJSON.box


  # for pages which require authentication
  # and being visited directly from outside
  showOnLoad: =>
    return unless window.showVerificationModal

    window.showVerificationModal = null
    @show()
