# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

fixedElements = document.getElementsByClassName('js-fixed-element')

$(document).on 'shown.bs.modal', '.modal', (e) ->
  $(e.target).find('.modal-af').focus()


$(document).on 'hidden.bs.modal', '.modal', ->
  $('.modal-backdrop').remove()
  $('body, .js-fixed-element').css paddingRight: ''


$(document).on 'show.bs.modal', '.modal', ->
  # trigger modal display immediately instead of waiting for backdrop animation to finish
  # have to wait a bit until the backdrop is created
  Timeout.set 10,  ->
    $('.modal-backdrop').trigger 'bsTransitionEnd'

  alignments = []

  for el, i in fixedElements
    alignments[i] = el.getBoundingClientRect()
    alignments[i].skip = getComputedStyle(el).position != 'fixed'

  for el, i in fixedElements
    continue if alignments[i].skip
    el.style.left = "#{alignments[i].left}px"
    el.style.width = "#{alignments[i].width}px"


$(document).on 'shown.bs.modal', '.modal', ->
  paddingRight = $('body').css('padding-right')

  skips = []

  for el, i in fixedElements
    skips[i] = getComputedStyle(el).position != 'fixed'

  for el, i in fixedElements
    continue if skips[i]
    el.style.paddingRight = paddingRight
    el.style.left = ''
    el.style.width = ''
