# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.AccountEdit
  constructor: ->
    $(document).on 'input change', '.js-account-edit', @initializeUpdate

    $(document).on 'ajax:error', '.js-account-edit', @ajaxError
    $(document).on 'ajax:send', '.js-account-edit', @ajaxSaving
    $(document).on 'ajax:success', '.js-account-edit', @ajaxSaved
    $(document).on 'ajax:success', '.js-user-preferences-update', @ajaxUserPreferencesUpdate


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


  ajaxUserPreferencesUpdate: (_e, user) ->
    $.publish 'user:update', user


  clearState: (el) =>
    el.dataset.accountEditState = ''


  getValue: (form) ->
    if form.dataset.accountEditType == 'array'
      prevValue = null

      value = ['']
      for checkbox in form.querySelectorAll('input')
        value.push(checkbox.value) if checkbox.checked
    else if form.dataset.accountEditType == 'radio'
      prevValue = form.dataset.lastValue

      for checkbox in form.querySelectorAll('input[type="radio"]')
        if checkbox.checked
          value = checkbox.value
          break
    else
      prevValue = form.dataset.lastValue

      input = form.querySelector('.js-account-edit__input')
      if input.type == 'checkbox'
        value = input.checked
      else
        value = input.value

    { value, prevValue }


  getMultiValue: (form) ->
    data = {}

    for checkbox in form.querySelectorAll('.js-account-edit__input')
      data[checkbox.name] = checkbox.checked

    data


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
    if form.dataset.accountEditType == 'multi'
      data = @getMultiValue(form)
    else
      { value, prevValue } = @getValue(form)

      return @clearState(form) if value == prevValue
      input = form.querySelector('.js-account-edit__input')
      field = form.dataset.field ? input.name
      form.dataset.lastValue = value
      data = "#{field}": value

    url = form.dataset.url ? laroute.route('account.update')

    form.updating = $.ajax url,
      method: 'PUT'
      data: data

    .done (data) =>
      @saved form
      $(form).trigger 'ajax:success', data

    .fail (xhr, status) =>
      return if status == 'abort'

      form.lastValue = prevValue
      @clearState form
      $(form).trigger 'ajax:error', [xhr, status]
