###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

fixedElements = document.getElementsByClassName('js-fixed-element')

$(document).on 'shown.bs.modal', '.modal', (e) ->
  # safari breaks when calling focus() on most conditions.
  return if osu.isIos

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
