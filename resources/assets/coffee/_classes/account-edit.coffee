###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

class @AccountEdit
  constructor: ->
    $(document).on 'input', '.js-account-edit__input', @initializeUpdate


  initializeUpdate: (e) =>
    e.currentTarget.debouncedUpdate ?= _.debounce @update, 1000
    e.currentTarget.debouncedUpdate e


  update: (e) =>
    input = e.currentTarget
    value = input.value
    prevValue = input.dataset.lastValue
    $main = $(input).closest('.js-account-edit')

    return if value == prevValue

    input.dataset.lastValue = value
    Timeout.clear input.savedTimeout
    Timeout.clear input.savingTimeout

    input.savingTimeout = Timeout.set 1000, =>
      $main.addClass 'js-account-edit--saving'

    $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        "#{input.name}": value

    .done =>
      $main.addClass 'js-account-edit--saved'

      input.savedTimeout = Timeout.set 3000, =>
        $main.removeClass 'js-account-edit--saved'

    .fail (xhr) =>
      input.lastValue = prevValue
      osu.ajaxError xhr

    .always =>
      Timeout.clear input.savingTimeout
      $main.removeClass 'js-account-edit--saving'
