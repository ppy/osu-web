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

    $(document).on 'ajax:error', '.js-account-edit', @ajaxError
    $(document).on 'ajax:send', '.js-account-edit', @ajaxSaving
    $(document).on 'ajax:success', '.js-account-edit', @ajaxSaved


  initializeUpdate: (e) =>
    e.currentTarget.debouncedUpdate ?= _.debounce @update, 1000
    e.currentTarget.debouncedUpdate e


  ajaxError: (e) =>
    @clearState e.currentTarget


  ajaxSaving: (e) =>
    @saving e.currentTarget


  ajaxSaved: (e) =>
    @saved e.currentTarget


  clearState: (el) =>
    el.dataset.accountEditState = ''


  saved: (el) =>
    el.dataset.accountEditState = 'saved'

    Timeout.set 3000, =>
      @clearState el


  saving: (el) =>
    el.dataset.accountEditState = 'saving'


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
      @saving $main[0]

    $.ajax laroute.route('account.update'),
      method: 'PUT'
      data:
        "#{input.name}": value

    .done =>
      @saved $main[0]

    .fail (xhr) =>
      input.lastValue = prevValue
      osu.ajaxError xhr

    .always =>
      Timeout.clear input.savingTimeout
      $main.removeClass 'js-account-edit--saving'
