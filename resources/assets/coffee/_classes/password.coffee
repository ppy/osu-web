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

class @Password
  constructor: ->
    @base = document.getElementsByClassName('js-password')
    @dom = {}

    $(document).on 'input', '.js-password[data-password-field=current_password] .js-password--input', @inputCurrent
    $(document).on 'input', '.js-password[data-password-field=password] .js-password--input', @inputNew
    $(document).on 'input', '.js-password[data-password-field=password_confirmation] .js-password--input', @inputConfirmation
    $(document).on 'turbolinks:load', @reboot
    $(document).on 'ajax:success', '.js-password--form', @clear
    $(document).on 'ajax:error', '.js-password--form', @fail


  clear: =>
    for own field, elements of @dom
      elements.input.value = ''
      @setError field, ''


  fail: (_event, xhr) =>
    data = xhr.responseJSON
    if data?
      @setError data.field, data.message
    else
      osu.popup Lang.get('errors.unkown'), 'danger'


  inputConfirmation: =>
    confirmation = @dom.password_confirmation.input.value
    error =
      if confirmation in ['', @dom.password.input.value]
        ''
      else
        Lang.get('accounts.update_password.error.wrong_confirmation')

    @setError 'password_confirmation', error


  inputCurrent: =>
    @setError 'current_password', ''


  inputNew: =>
    @setError 'password', ''


  reboot: =>
    return if !@base[0]?

    for field in ['current_password', 'password', 'password_confirmation']
      label = document.querySelector(".js-password[data-password-field=#{field}]")
      input = label.querySelector('.js-password--input')
      error = label.querySelector('.js-password--error')

      @dom[field] = {error, input, label}
      $(input).on 'input', @refresh


  setError: (field, message) =>
    {label, error} = @dom[field]

    return if (error.textContent == message)

    label.dataset.fieldState = if message == '' then '' else 'error'
    error.textContent = message
