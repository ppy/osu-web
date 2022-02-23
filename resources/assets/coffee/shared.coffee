# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

# Avoid triggering submit when pressing enter since both
# submit and change will be triggered.
# Moreover, blurring the input will trigger the 'change' event.
# That part is handled by storing the submitted value in the DOM.
$(document).on 'keypress', '.js-auto-submit', (e) ->
  # 13 == enter key
  return unless e.which == 13
  e.preventDefault()
  $(e.target).trigger 'change'

# automatically submit on change
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
$(document).on 'turbolinks:load', ->
  $('.content-editable-submit').each (_i, el) ->
    $el = $(el)
    $el.data('last-submitted-value', $el.html())

# fadeOut effect for popup
$(document).on 'click', '#popup-container, #overlay', (e) ->
  $('#overlay').fadeOut()
  $popup = $(e.target).closest('.popup-active')
  $popup.fadeOut null, -> $popup.remove()


###
#    Add `disabled` attribute to form element with value _disabled.
#    Currently used to work around Form::select (in store checkout -
#    new address form - country selection) since it doesn't support
#    adding a disabled value.
###
$(document).on 'turbolinks:load', ->
  $('[value=_disabled]').attr 'disabled', true


###
#    Click anywhere on row to click the main link!
#    Usage:
#    1. add class `clickable-row` to the row
#    2. add class `clickable-row-link` to the link that should be
#       clicked when the row is clicked
#    3. ???
#    4. profit!
#    May contain caveats.
###
$(document).on 'click', '.clickable-row', (e) ->
  target = e.target

  return if osu.isClickable target

  row = e.currentTarget
  if row.classList.contains 'clickable-row-link'
    row.click()
  else
    row.getElementsByClassName('clickable-row-link')[0]?.click()


# submit form on ctrl-enter (or cmd-enter).
$(document).on 'keydown', '.js-quick-submit', (e) ->
  return unless (e.ctrlKey || e.metaKey) && e.keyCode == 13

  e.preventDefault()
  $(e.target).closest('form').submit()


$(document).on 'ajax:beforeSend', (e) ->
  # currentTarget is document
  form = e.target

  return false if form._submitting

  form._submitting = true

  form._ujsSubmitDisabled = []
  for el in form.querySelectorAll('.js-ujs-submit-disable')
    continue if el.disabled

    el.blur() if el.dataset.blurOnSubmitDisable == '1'
    el.disabled = true
    form._ujsSubmitDisabled.push el


$(document).on 'ajax:complete', (e) ->
  form = e.target

  form._submitting = false
  el.disabled = false while el = form._ujsSubmitDisabled.pop()
