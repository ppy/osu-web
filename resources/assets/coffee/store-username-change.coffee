# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

preventUsernameSubmission = ->
  StoreCart.setEnabled(false)
  $('#username-check-price').text ''

checkUsernameValidity = ->
  $status = $('#username-check-status')
  requestedUsername = $('.js-username-change-input').val()

  $.post laroute.route('users.check-username-availability'), username: requestedUsername
  .done (data) ->
    return unless data.username == $('.js-username-change-input').val()

    if data.available
      $('.js-store-add-to-cart').attr 'disabled', false
      $('#username-check-price').text data.costString
      $('#username-form-price').val data.cost
      $('#product-form').data('disabled', false)
    else
      preventUsernameSubmission()

    $status.html data.message
    $status.toggleClass 'green-dark', data.available
    $status.toggleClass 'pink-dark', !data.available
  .fail (xhr, status) ->
    $('.js-username-change-input')
      .trigger 'ajax:error', [xhr, status]
      .one 'click', checkUsernameValidity

debouncedCheckUsernameValidity = _.debounce checkUsernameValidity, 300

$(document).on 'input', '.js-username-change-input', (e) ->
  input = e.currentTarget
  $status = $('#username-check-status')
  requestedUsername = input.value

  $status.removeClass 'green-dark'
  $status.removeClass 'pink-dark'
  preventUsernameSubmission()

  if requestedUsername.length == 0
    $status.text osu.trans('store.username_change.check')
  else
    $status.text osu.trans('store.username_change.checking', username: requestedUsername)
    debouncedCheckUsernameValidity()

$(document).on 'turbolinks:load', ->
  return if $('.js-username-change-input').length == 0
  preventUsernameSubmission()
