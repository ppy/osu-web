###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License version 3
as published by the Free Software Foundation.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
# address form show/hide.
$(document).on 'click', '#new-address-switch a', (e) ->
  e.preventDefault()
  $target = $(e.target)
  $form = $('#new-address-form')

  if $target.is(':visible')
    $target.siblings('button').show()
    $target.hide()
    $form.find('input').first().focus()
  else
    $target.siblings('button').hide()
    $target.show()
  $form.slideToggle()


preventUsernameSubmission = ->
  $('.js-store-add-to-cart').attr 'disabled', true
  $('#product-form').data('disabled', true)
  $('#username-check-price').html ''

checkUsernameValidity = ->
  $status = $('#username-check-status')
  requestedUsername = $('#username.form-control').val()

  $.post '/users/check-username-availability', username: requestedUsername
  .done (data) ->
    return unless data.username == requestedUsername

    if data.available
      $('.js-store-add-to-cart').attr 'disabled', false
      $('#username-check-price').html data.costString
      $('#username-form-price').val data.cost
      $('#product-form').data('disabled', false)
    else
      preventUsernameSubmission()

    $status.html data.message
    $status.toggleClass 'green-dark', data.available
    $status.toggleClass 'pink-dark', !data.available
  .fail (xhr) ->
    if xhr.status == 401
      osu.popup Lang.get('errors.logged_out'), 'danger'


debouncedCheckUsernameValidity = _.debounce checkUsernameValidity, 300


$(document).on 'input', '#username.form-control', ->
  $status = $('#username-check-status')
  requestedUsername = $('#username.form-control').val()

  $status.removeClass 'green-dark'
  $status.removeClass 'pink-dark'
  preventUsernameSubmission()

  if requestedUsername.length == 0
    $status.html 'Enter a username to check availability!'
  else
    $status.html "Checking availability of #{requestedUsername}..."
    debouncedCheckUsernameValidity()


$(document).on 'ready page:load', ->
  quantity = parseInt $('.js-store-item-quantity').val(), 10

  return if quantity > 0

  $('.js-store-add-to-cart').hide()


$(document).on 'ready page:load', ->
  return if $('#username.form-control').length == 0

  preventUsernameSubmission()

$(document).on 'ready page:load', ->
  # delegating doesn't work because of timing.
  $('#product-form').submit (e) ->
    !$(e.target).data('disabled')
