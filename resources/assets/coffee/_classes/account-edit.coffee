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

class @AccountEdit
  constructor: ->
    $(document).on 'input change', '.js-account-edit', @initializeUpdate

    $(document).on 'ajax:error', '.js-account-edit', @ajaxError
    $(document).on 'ajax:send', '.js-account-edit', @ajaxSaving
    $(document).on 'ajax:success', '.js-account-edit', @ajaxSaved


  initializeUpdate: (e) =>
    form = e.currentTarget

    return if form.dataset.accountEditAutoSubmit != '1'

    @abortUpdate form
    @saving form
    form.debouncedUpdate ?= _.debounce @update, 1000
    form.debouncedUpdate form


  ajaxError: (e) =>
    @clearState e.currentTarget


  ajaxSaving: (e) =>
    @saving e.currentTarget


  ajaxSaved: (e) =>
    @saved e.currentTarget


  clearState: (el) =>
    el.dataset.accountEditState = ''


  getValue: (form) ->
    if form.dataset.accountEditType == 'array'
      prevValue = null

      value = ['']
      for checkbox in form.querySelectorAll('input')
        value.push(checkbox.value) if checkbox.checked
    else
      prevValue = form.dataset.lastValue

      input = form.querySelector('.js-account-edit__input')
      if input.type == 'checkbox'
        value = input.checked
      else
        value = input.value.trim()

    { value, prevValue }


  saved: (el) =>
    el.dataset.accountEditState = 'saved'

    el.savedTimeout = Timeout.set 3000, =>
      @clearState el


  saving: (el) =>
    el.dataset.accountEditState = 'saving'


  abortUpdate: (form) =>
    Timeout.clear form.savedTimeout
    form.updating?.abort()
    @clearState form


  update: (form) =>
    { value, prevValue } = @getValue(form)

    return @clearState(form) if value == prevValue

    form.dataset.lastValue = value

    url = form.dataset.url ? laroute.route('account.update')
    input = form.querySelector('.js-account-edit__input')
    field = form.dataset.field ? input.name

    form.updating = $.ajax url,
      method: 'PUT'
      data:
        "#{field}": value

    .done =>
      @saved form
      $(form).trigger 'ajax:success'

    .fail (xhr, status) =>
      return if status == 'abort'

      form.lastValue = prevValue
      @clearState form
      $(form).trigger 'ajax:error', [xhr, status]
