# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

insert = (event, tagOpen, tagClose = '') ->
  $box = $(event.target).parents('form').find('[name=body], .js-bbcode-body')
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

  $box
    .trigger 'bbcode:inserted' # for react
    .trigger 'input' # ignored by react
    .focus()

[
  ['bold', '[b]', '[/b]']
  ['heading', '[heading]', '[/heading]']
  ['image', '[img]', '[/img]']
  ['imagemap', '[imagemap]\nhttps://example.com/image.jpg\n0 10 10 50 https://example.com example\n', '[/imagemap]']
  ['italic', '[i]', '[/i]']
  ['link', '[url]', '[/url]']
  ['list', '[list]\n[*]', '[/list]']
  ['list-numbered', '[list=1]\n[*]', '[/list]']
  ['strikethrough', '[s]', '[/s]']
  ['underline', '[u]', '[/u]']
  ['spoilerbox', '[box=]', '[/box]']
].forEach (tagOptions) ->
  [buttonClass, openTag, closeTag] = tagOptions
  $(document).on 'click', ".js-bbcode-btn--#{buttonClass}", (e) ->
    insert e, openTag, closeTag


$(document).on 'turbolinks:load', ->
  $('.js-bbcode-btn--size').val('')


$(document).on 'change', '.js-bbcode-btn--size', (e) ->
  $select = $(e.target)
  val = parseInt $select.val(), 10
  $select.val('')

  insert e, "[size=#{val}]", '[/size]'
