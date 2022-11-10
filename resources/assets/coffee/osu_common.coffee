# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { formatNumber } from 'utils/html'
import { currentUrl, navigate } from 'utils/turbolinks'

window.osu =
  reloadPage: (keepScroll = true) ->
    $(document).off '.ujsHideLoadingOverlay'
    Turbolinks.clearCache()

    navigate currentUrl().href, keepScroll, action: 'replace'


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


  presence: (string) ->
    if osu.present(string) then string else null


  present: (string) ->
    string? && string != ''


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
    locale ?= currentLocale
    isFallbackLocale = locale == fallbackLocale

    if !isFallbackLocale && !osu.transExists(key, locale)
      return osu.transChoice(key, count, replacements, fallbackLocale)

    replacements.count_delimited = formatNumber(count, null, null, locale)
    translated = Lang.choice(key, count, replacements, locale)

    if !isFallbackLocale && !translated?
      # added by Lang.choice
      delete replacements.count

      return osu.transChoice(key, count, replacements, fallbackLocale)

    translated


  # Handles case where crowdin fills in untranslated key with empty string.
  transExists: (key, locale) ->
    translated = Lang.get(key, null, locale)

    osu.present(translated) && translated != key
