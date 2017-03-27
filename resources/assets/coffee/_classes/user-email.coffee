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

class @UserEmail
  constructor: ->
    @base = document.getElementsByClassName('js-user-email')
    @dom = {}

    $(document).on 'turbolinks:load', @reboot
    $(document).on 'ajax:success', '.js-user-email--form', @clear
    $(document).on 'ajax:error', '.js-user-email--form', @fail


  clear: =>
    for own field, elements of @dom
      elements.input.value = ''
      @setError field, ''


  fail: (_event, xhr) =>
    data = xhr.responseJSON
    if data?
      for own field, messages of data
        @setError field, messages.join(', ')
    else
      osu.popup Lang.get('errors.unkown'), 'danger'


  inputConfirmation: =>
    confirmation = @dom.email_confirmation.input.value
    error =
      if confirmation in ['', @dom.email.input.value]
        ''
      else
        Lang.get('model_validation.user_email.wrong_confirmation')

    @setError 'email_confirmation', error


  inputPassword: =>
    @setError 'current_password', ''


  inputNew: =>
    @setError 'email', ''


  reboot: =>
    return if !@base[0]?

    for field in ['current_password', 'email', 'email_confirmation']
      label = document.querySelector(".js-user-email[data-user-email-field=#{field}]")
      input = label.querySelector('.js-user-email--input')
      error = label.querySelector('.js-user-email--error')

      @dom[field] = {error, input, label}

    $(@dom.current_password.input).on 'input', @inputPassword
    $(@dom.email.input).on 'input', @inputNew
    $(@dom.email_confirmation.input).on 'input', @inputConfirmation


  setError: (field, message) =>
    {label, error} = @dom[field]

    return if (error.textContent == message)

    label.dataset.fieldState = if message == '' then '' else 'error'
    error.textContent = message
