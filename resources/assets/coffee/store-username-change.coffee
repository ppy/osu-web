preventUsernameSubmission = ->
  StoreCart.setEnabled(false)
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
      osu.popup osu.trans('errors.logged_out'), 'danger'

debouncedCheckUsernameValidity = _.debounce checkUsernameValidity, 300

$(document).on 'input', '.js-username-change #username.form-control', ->
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

$(document).on 'turbolinks:load', ->
  return if $('.js-username-change #username.form-control').length == 0
  preventUsernameSubmission()
