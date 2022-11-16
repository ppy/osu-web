# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { formatNumber } from 'utils/html'
import { present } from 'utils/string'
import { trans, transArray, transExists } from 'utils/lang'
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


  trans: (key, replacements = {}, locale) ->
    trans(key, replacements, locale)


  transArray: (array, key = 'common.array_and') ->
    transArray(array, key)


  transChoice: (key, count, replacements = {}, locale) ->
    transChoice(key, count, replacements, locale)


  # Handles case where crowdin fills in untranslated key with empty string.
  transExists: (key, locale) ->
    transExists(key, locale)
