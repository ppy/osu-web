###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

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


galleryArray = ->
  $('.js-store-product--thumbnail').map (_i, el) ->
    $el = $(el)
    {
      msrc: $el.attr('href')
      src: $el.attr('href')
      w: parseInt $el.attr('data-size-w'), 10
      h: parseInt $el.attr('data-size-h'), 10
    }
  .get()


galleryStartBounds = (i) ->
  $thumb = $(".js-store-product--thumbnail[data-index='#{i}']")
  thumbPos = $thumb.offset()

  thumbDim = [
    $thumb.width()
    $thumb.height()
  ]

  center = [
    thumbPos.left + thumbDim[0] / 2
    thumbPos.top + thumbDim[1] / 2
  ]

  imageDim = [
    parseInt $thumb.attr('data-size-w'), 10
    parseInt $thumb.attr('data-size-h'), 10
  ]

  scale = Math.max thumbDim[0] / imageDim[0], thumbDim[1] / imageDim[1]
  scaledImageDim = imageDim.map (s) -> s * scale

  {
    x: center[0] - scaledImageDim[0] / 2
    y: center[1] - scaledImageDim[1] / 2
    w: scaledImageDim[0]
  }


openGallery = (index) ->
  pswpElement = $('.pswp')[0]
  items = galleryArray()
  options =
    showHideOpacity: true
    getThumbBoundsFn: galleryStartBounds
    index: index
    history: false
  gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options)
  gallery.init()


$(document).on 'click', '#product-slides a', (e) ->
  e.preventDefault()
  openGallery parseInt($(e.target).attr('data-index'), 10)


preventUsernameSubmission = ->
  $('#add-to-cart').slideUp()
  $('#product-form').data('disabled', true)
  $('#username-check-price').html ''

checkUsernameValidity = ->
  $status = $('#username-check-status')
  requestedUsername = $('#username.form-control').val()

  $.post '/users/check-username-availability', username: requestedUsername
  .done (data) ->
    return unless data.username == requestedUsername

    if data.available
      $('#add-to-cart').slideDown()
      $('#username-check-price').html data.costString
      $('#username-form-price').val data.cost
      $('#product-form').data('disabled', false)
    else
      preventUsernameSubmission()

    $status.html data.message
    $status.toggleClass 'green-dark', data.available
    $status.toggleClass 'pink-dark', !data.available


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
    _.debounce(checkUsernameValidity, 300).call()


$(document).on 'ready page:load', ->
  return if $('#username.form-control').length == 0

  $('#add-to-cart').hide()
  preventUsernameSubmission()

$(document).on 'ready page:load', ->
  # delegating doesn't work because of timing.
  $('#product-form').submit (e) ->
    !$(e.target).data('disabled')
