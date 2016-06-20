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
# automatically submit on change

# Avoid triggering submit when pressing enter since both
# submit and change will be triggered.
# Moreover, blurring the input will trigger the 'change' event.
# That part is handled by storing the submitted value in the DOM.
$(document).on 'keypress', '.js-auto-submit', (e) ->
  # 13 == enter key
  return unless e.which == 13
  e.preventDefault()
  $(e.target).trigger 'change'

$(document).on 'change', '.js-auto-submit', (e) ->
  $target = $(e.target)
  return if $target.val() == $target.data('last-submitted-value')

  $target.data('last-submitted-value', $target.val())
  $target.parents('form').submit()

# A class to make contenteditable fields useful inside of forms.
$(document).on 'keypress', '.content-editable-submit', (e) ->
  # 13 == enter key
  return unless e.which == 13
  e.preventDefault()
  $(e.target).trigger 'blur'

$(document).on 'blur', '.content-editable-submit', (e) ->
  $target = $(e.target)
  return if $target.html() == $target.data('last-submitted-value')

  $target.data('last-submitted-value', $target.html())

  $form = $target.parents('form')

  el = $(document.createElement('input'))
  el.attr('type', 'hidden')
  el.attr('name', $target.attr('data-name'))
  el.attr('value', $target.html())

  # temporarily add a hidden form element for this contenteditable field.
  $form.append(el);

  $form.submit()

  # remove now that we're done submitting.
  el.remove()

#populate last-submitted values
$(document).on 'ready turbolinks:load', ->
  $('.content-editable-submit').each (_i, el) ->
    $el = $(el)
    $el.data('last-submitted-value', $el.html())

# fadeOut effect for popup
$(document).on 'click', '#popup-container, #overlay', (e) ->
  $('#overlay').fadeOut()
  $popup = $(e.target).closest('.popup-active')
  $popup.fadeOut null, $popup.remove


# prevent clicking gallery button from navigating to `#`
$(document).on 'click', '.pswp a', (e) -> e.preventDefault()


# image slider
$(document).on 'ready turbolinks:load', ->
  $('.rslides').responsiveSlides
    auto: false
    manualControls: '.rslides-nav'


###
# Add `disabled` attribute to form element with value _disabled.
# Currently used to work around Form::select (in store checkout -
# new address form - country selection) since it doesn't support
# adding a disabled value.
###
$(document).on 'ready turbolinks:load', ->
  $('[value=_disabled]').attr 'disabled', true


###
* Click anywhere on row to click the main link!
* Usage:
* 1. add class `clickable-row` to the row
* 2. add class `clickable-row-link` to the link that should be
*    clicked when the row is clicked
* 3. ???
* 4. profit!
* May contain caveats.
###
$(document).on 'click', '.clickable-row', (e) ->
  $target = $(e.target)
  isTargetClickable =
    $target.closest('a').length != 0 ||
    $target.closest('button').length != 0 ||
    $target.closest('input').length != 0

  return if isTargetClickable
  $target.closest('.clickable-row').find('.clickable-row-link')[0].click()


# submit form on ctrl-enter.
$(document).on 'keydown', '.js-quick-submit', (e) ->
  return unless e.ctrlKey && e.keyCode == 13

  e.preventDefault()
  $(e.target).closest('form').submit()
