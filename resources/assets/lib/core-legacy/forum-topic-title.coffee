# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

export default class ForumTopicTitle
  constructor: ->
    @input = document.getElementsByClassName('js-forum-topic-title--input')
    @saveButton = document.getElementsByClassName('js-forum-topic-title--save')
    @title = document.getElementsByClassName('js-forum-topic-title--title')
    @toggleables = document.getElementsByClassName('js-forum-topic-title--toggleable')

    addEventListener 'turbolinks:before-cache', @abort
    $(document).on 'click', '.js-forum-topic-title--edit-start', @editShow
    $(document).on 'click', '.js-forum-topic-title--save', @save
    $(document).on 'keyup', '.js-forum-topic-title--input', @onKeyup
    $(document).on 'click', '.js-forum-topic-title--cancel', @cancel
    $(document).on 'input', '.js-forum-topic-title--input', @onInput


  abort: =>
    @xhr?.abort()


  cancel: =>
    @abort()
    $(@toggleables).removeAttr('data-title-edit')
    @input[0].value = @input[0].defaultValue


  editShow: =>
    $(@toggleables).attr('data-title-edit', 1)
    @input[0].selectionStart = @input[0].value.length
    @input[0].focus()


  onInput: =>
    @saveButton[0].disabled = !osu.present(@input[0].value)


  onKeyup: (e) =>
    switch e.keyCode
      # enter
      when 13 then @save()
      # escape
      when 27 then @cancel()


  save: =>
    input = @input[0]
    newTitle = input.value

    return if !osu.presence(newTitle)?

    return @cancel() if newTitle == input.defaultValue

    input.disabled = true
    @saveButton[0].disabled = true

    @abort()
    @xhr = $.ajax input.dataset.url,
      method: 'PUT'
      data:
        "#{input.name}": newTitle
    .done =>
      # because page title is also changed =D
      osu.reloadPage()
    .fail (xhr) =>
      input.disabled = false
      @saveButton[0].disabled = false
      osu.emitAjaxError() xhr
