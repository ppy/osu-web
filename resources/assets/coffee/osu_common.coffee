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

@osu =
  isIos: /iPad|iPhone|iPod/.test(navigator.platform)
  urlRegex: /(https?:\/\/(?:(?:[a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9](?::\d+)?)(?:(?:(?:\/+(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)*(?:\?(?:[a-z0-9$_\.\+!\*',;:@&=-]|%[0-9a-f]{2})*)?)?(?:#(?:[a-z0-9$_\.\+!\*',;:@&=/?-]|%[0-9a-f]{2})*)?)?)/ig

  bottomPage: ->
    osu.bottomPageDistance() == 0


  bottomPageDistance: ->
    body = document.documentElement ? document.body.parent ? document.body
    (body.scrollHeight - body.scrollTop) - body.clientHeight


  classWithModifiers: (className, modifiers) ->
    ret = className

    if modifiers?
      ret += " #{className}--#{modifier}" for modifier in modifiers when modifier?

    ret


  currentUserIsFriendsWith: (user_id) ->
    _.find currentUser.friends, target_id: user_id


  executeAction: (element) =>
    if !element?
      osu.reloadPage()
      return

    if element.dataset.isFileupload == '1'
      $(element).trigger 'fileuploadRetry'
    else if element.submit
      # plain javascript here doesn't trigger submit events
      # which means jquery-ujs handler won't be triggered
      # reference: https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit
      $(element).submit()
    else if element.click
      # inversely, using jquery here won't actually click the thing
      # reference: https://github.com/jquery/jquery/blob/f5aa89af7029ae6b9203c2d3e551a8554a0b4b89/src/event.js#L586
      element.click()


  setHash: (newHash) ->
    newUrl = location.href.replace /#.*/, ''
    newUrl += newHash

    return if newUrl == location.href

    history.replaceState history.state, null, newUrl


  ajaxError: (xhr) ->
    osu.popup osu.xhrErrorMessage(xhr), 'danger'


  emitAjaxError: (element = document.body) =>
    (xhr, status, error) =>
      $(element).trigger 'ajax:error', [xhr, status, error]


  fileuploadFailCallback: ($elFunction) =>
    (_e, data) =>
      $el = $elFunction()
      $el[0].dataset.isFileupload ?= '1'

      $el
      .off 'fileuploadRetry'
      .one 'fileuploadRetry', =>
        data.submit()

      osu.emitAjaxError($el[0]) data.jqXHR


  pageChange: ->
    Timeout.set 0, osu.pageChangeImmediate


  pageChangeImmediate: ->
    $(document).trigger('osu:page:change')


  parseJson: (id) ->
    JSON.parse document.getElementById(id)?.text ? null


  storeJson: (id, object) ->
    json = JSON.stringify object
    element = document.getElementById(id)

    if !element?
      element = document.createElement 'script'
      element.id = id
      element.type = 'application/json'
      document.body.appendChild element

    element.text = json


  # make a clone of json-like object (object with simple values)
  jsonClone: (object) ->
    JSON.parse JSON.stringify(object ? null)


  isInputElement: (el) ->
    el.tagName in ['INPUT', 'SELECT', 'TEXTAREA'] || el.isContentEditable


  isClickable: (el) ->
    if osu.isInputElement(el) || el.tagName in ['A', 'BUTTON']
      true
    else if el.parentNode
      osu.isClickable el.parentNode
    else
      false


  isDesktop: ->
    # sync with boostrap-variables @screen-sm-min
    window.matchMedia('(min-width: 900px)').matches


  isMobile: -> !osu.isDesktop()


  # mobile safari zooms in on focus of input boxes with font-size < 16px, this works around that
  focus: (el) =>
    el = $(el)[0] # so we can handle both jquery'd and normal dom nodes
    return el.focus() if !osu.isIos

    prevSize = el.style.fontSize
    el.style.fontSize = '16px'
    el.focus()
    el.style.fontSize = prevSize


  src2x: (mainUrl) ->
    src: mainUrl
    srcSet: "#{mainUrl} 1x, #{mainUrl?.replace(/(\.[^.]+)$/, '@2x$1')} 2x"


  link: (url, text, options = {}) ->
    el = document.createElement('a')
    el.setAttribute 'href', url
    el.setAttribute 'data-remote', true if options.isRemote
    el.className = options.classNames.join(' ') if options.classNames
    el.textContent = text
    if options.props
      _.each options.props, (val, prop) ->
        el.setAttribute prop, val
    el.outerHTML


  linkify: (text) ->
    return text.replace(osu.urlRegex, '<a href="$1" rel="nofollow">$1</a>')


  timeago: (time) ->
    el = document.createElement('time')
    el.classList.add 'timeago'
    el.setAttribute 'datetime', time
    el.textContent = time
    el.outerHTML


  formatBytes: (bytes, decimals=2) ->
    suffixes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
    k = 1000

    return "#{bytes} B" if (bytes < k)

    i = Math.floor(Math.log(bytes) / Math.log(k))
    "#{osu.formatNumber(bytes / Math.pow(k, i), decimals)} #{suffixes[i]}"


  formatNumber: (number, precision, options, locale) ->
    return null unless number?

    options ?= {}

    if precision?
      options.minimumFractionDigits = precision
      options.maximumFractionDigits = precision

    number.toLocaleString locale ? currentLocale, options


  formatNumberSuffixed: (number, precision, options = {}) ->
    suffixes = ['', 'k', 'm', 'b', 't']
    k = 1000

    format = (n) ->
      options ?= {}

      if precision?
        options.minimumFractionDigits = precision
        options.maximumFractionDigits = precision

      n.toLocaleString 'en', options

    return "#{format number}" if (number < k)

    i = Math.min suffixes.length - 1, Math.floor(Math.log(number) / Math.log(k))
    "#{format(number / Math.pow(k, i))}#{suffixes[i]}"


  reloadPage: (keepScroll = true) ->
    $(document).off '.ujsHideLoadingOverlay'
    Turbolinks.clearCache()

    url =
      if !_.isEmpty window.reloadUrl
        window.reloadUrl
      else
        location.href

    window.reloadUrl = null

    osu.navigate url, keepScroll, action: 'replace'


  urlPresence: (url) ->
    "url(#{url})" if osu.presence(url)?


  navigate: (url, keepScroll, {action = 'advance'} = {}) ->
    osu.keepScrollOnLoad() if keepScroll
    Turbolinks.visit url, action: action


  keepScrollOnLoad: ->
    position = [
      window.pageXOffset
      window.pageYOffset
    ]

    $(document).one 'turbolinks:load', ->
      window.scrollTo position[0], position[1]


  popup: (message, type = 'info') ->
    $popup = $('#popup-container')
    $alert = $('.popup-clone').clone()

    closeAlert = -> $alert.click()

    # handle types of alerts by changing the colour
    $alert
      .addClass "alert-#{type} popup-active"
      .removeClass 'popup-clone'

    $alert.find('.popup-text').html message

    # warning/danger messages stay forever until clicked
    if type in ['warning', 'danger']
      $('#overlay')
        .off('click.close-alert')
        .one('click.close-alert', closeAlert)
        .fadeIn()
    else
      Timeout.set 5000, closeAlert

    document.activeElement.blur?()
    $alert.appendTo($popup).fadeIn()


  popupShowing: ->
    $('#overlay').is(':visible')


  presence: (string) ->
    if osu.present(string) then string else null


  present: (string) ->
    string? && string != ''


  promisify: (deferred) ->
    new Promise (resolve, reject) ->
      deferred
      .done resolve
      .fail reject


  trans: (key, replacements = {}, locale) ->
    locale = fallbackLocale unless osu.transExists(key, locale)

    Lang.get(key, replacements, locale)


  transArray: (array, key = 'common.array_and') ->
    switch array.length
      when 0
        ''
      when 1
        "#{array[0]}"
      when 2
        array.join(osu.trans("#{key}.two_words_connector"))
      else
        "#{array[...-1].join(osu.trans("#{key}.words_connector"))}#{osu.trans("#{key}.last_word_connector")}#{_.last(array)}"


  transChoice: (key, count, replacements = {}, locale) ->
    if !osu.transExists(key, locale)
      locale = fallbackLocale
      initialLocale = Lang.getLocale()
      Lang.setLocale locale

    replacements.count_delimited ?= osu.formatNumber(count, null, null, locale)
    translated = Lang.choice(key, count, replacements, locale)

    Lang.setLocale initialLocale if initialLocale?

    translated


  # Handles case where crowdin fills in untranslated key with empty string.
  transExists: (key, locale) ->
    translated = Lang.get(key, null, locale)

    osu.present(translated) && translated != key


  uuid: ->
    Turbolinks.uuid() # no point rolling our own


  updateQueryString: (url, params) ->
    urlObj = new URL(url ? window.location.href, document.location.origin)
    for own key, value of params
      urlObj.searchParams.set(key, value)

    return urlObj.href


  xhrErrorMessage: (xhr) ->
    validationMessage = xhr?.responseJSON?.validation_error

    if validationMessage?
      allErrors = []
      for own _field, errors of validationMessage
        allErrors = allErrors.concat(errors)

      message = "#{allErrors.join(', ')}."

    message ?= xhr?.responseJSON?.error

    if !message? || message == ''
      errorKey = "errors.codes.http-#{xhr?.status}"
      message = osu.trans errorKey
      message = osu.trans 'errors.unknown' if message == errorKey

    message
