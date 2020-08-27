# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @UserVerification
  constructor: ->
    addEventListener 'turbolinks:load', @setModal
    $(document).on 'ajax:error', @showOnError
    $(document).on 'turbolinks:load', @showOnLoad
    $(document).on 'input', '.js-user-verification--input', @autoSubmit
    $(document).on 'click', '.js-user-verification--reissue', @reissue
    $.subscribe 'user-verification:success', @success

    $(window).on 'resize scroll', @reposition

    # Used as callback on original action (where verification was required)
    @clickAfterVerification = null

    @inputBox = document.getElementsByClassName('js-user-verification--input')
    @message = document.getElementsByClassName('js-user-verification--message')
    @messageSpinner = document.getElementsByClassName('js-user-verification--message-spinner')
    @messageText = document.getElementsByClassName('js-user-verification--message-text')
    @reference = document.getElementsByClassName('js-user-verification--reference')


  $modal: => $('.js-user-verification')


  autoSubmit: (e) =>
    target = @inputBox[0]
    inputKey = target.value.replace /\s/g, ''
    lastKey = target.dataset.lastKey
    keyLength = parseInt(target.dataset.verificationKeyLength, 10)

    if inputKey.length == 0
      @setMessage()

    return if keyLength != inputKey.length
    return if inputKey == lastKey

    target.dataset.lastKey = inputKey

    @prepareForRequest 'verifying'

    @request =
      $.post laroute.route('account.verify'),
        verification_key: inputKey
      .done @success
      .fail @error


  isVerificationPage: ->
    document.querySelector('.js-user-verification--on-load')?


  error: (xhr) =>
    @setMessage osu.xhrErrorMessage(xhr)


  float: (float, modal = @modal, referenceBottom) =>
    if float
      modal.classList.add 'js-user-verification--center'
      modal.style.paddingTop = null
    else
      modal.classList.remove 'js-user-verification--center'
      modal.style.paddingTop = "#{referenceBottom}px"


  isActive: =>
    @modal?.classList.contains('js-user-verification--active')


  prepareForRequest: (type) =>
    @request?.abort()
    @setMessage osu.trans("user_verification.box.#{type}"), true


  reissue: (e) =>
    e.preventDefault()

    @prepareForRequest 'issuing'

    @request =
      $.post laroute.route('account.reissue-code')
      .done (data) =>
        @setMessage data.message
      .fail @error


  reposition: =>
    return unless @isActive()

    if osu.isMobile()
      @float(true, @modal)
    else
      referenceBottom = @reference[0]?.getBoundingClientRect().bottom

      @float(referenceBottom < 0, @modal, referenceBottom)


  setMessage: (text, withSpinner = false) =>
    if !text? || text.length == 0
      Fade.out @message[0]
      return

    @messageText[0].textContent = text
    Fade.toggle @messageSpinner[0], withSpinner
    Fade.in @message[0]


  setModal: =>
    @modal = document.querySelector('.js-user-verification')


  success: =>
    return unless @isActive()

    @$modal().modal 'hide'
    @modal.classList.remove('js-user-verification--active')

    toClick = @clickAfterVerification
    @clickAfterVerification = null
    @setMessage()
    @inputBox[0].value = ''
    @inputBox[0].dataset.lastKey = ''

    return osu.reloadPage() if @isVerificationPage()

    osu.executeAction(toClick) if toClick?


  show: (target, html) =>
    @clickAfterVerification = target

    if html?
      $('.js-user-verification--box').html html

    @$modal()
    .modal
      backdrop: 'static'
      keyboard: false
      show: true
    .addClass 'js-user-verification--active'

    @reposition()


  showOnError: ({target}, xhr) =>
    return false unless xhr.status == 401 && xhr.responseJSON?.authentication == 'verify'

    @show target, xhr.responseJSON.box

    true


  # for pages which require authentication
  # and being visited directly from outside
  showOnLoad: =>
    @show() if @isVerificationPage()
