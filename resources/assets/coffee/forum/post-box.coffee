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
insert = (event, tagOpen, tagClose = '') ->
  $box = $(event.target).parents('form').find('[name=body]')
  boxText = $box.val()
  box = $box[0]
  startPos = box.selectionStart
  endPos = box.selectionEnd
  texts = [
    boxText.substring(0, startPos)
    boxText.substring(startPos, endPos)
    boxText.substring(endPos)
  ]

  texts[0] = texts[0] + tagOpen
  texts[2] = tagClose + texts[2]

  if startPos == endPos
    $box.val texts[0] + texts[2]
    box.selectionStart = texts[0].length
    box.selectionEnd = box.selectionStart
  else
    $box.val texts[0] + texts[1] + texts[2]
    box.selectionStart = startPos
    box.selectionEnd = texts[0].length + texts[1].length + tagClose.length

  $box.trigger 'change'
  $box.focus()

[
  ['bold', '[b]', '[/b]']
  ['heading', '[heading]', '[/heading]']
  ['image', '[img]', '[/img]']
  ['italic', '[i]', '[/i]']
  ['link', '[url]', '[/url]']
  ['list', '[list]\n[*]', '[/list]']
  ['list-numbered', '[list=1]\n[*]', '[/list]']
  ['strikethrough', '[s]', '[/s]']
  ['underline', '[u]', '[/u]']
  ['spoilerbox', '[box=]', '[/box]']
].forEach (tagOptions) ->
  [buttonClass, openTag, closeTag] = tagOptions
  $(document).on 'click', ".bbcode-btn--#{buttonClass}", (e) ->
    insert e, openTag, closeTag


$(document).on 'change', '.bbcode-size', (e) ->
  $select = $(e.target)
  val = parseInt $select.val(), 10

  return if val == 100

  insert e, "[size=#{val}]", '[/size]'


class PostAutoPreview
  lastBody: null

  constructor: ->
    $(document).on 'keyup change', '.post-autopreview', _.debounce(@loadPreview, 500)

  loadPreview: (e) =>
    $form = $(e.target).closest('form')
    url = $form.attr('data-preview-url')
    body = $form.find('[name=body]').val()
    $preview = $form.find('.js-post-preview')

    return if @lastBody == body

    $.post(url, body: body)
    .done (data) =>
      @lastBody = body
      $preview.html data
      osu.pageChange()

window.postAutoPreview = new PostAutoPreview
