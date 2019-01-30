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


class @ForumTopicTitle
  constructor: ->
    @buttons = document.getElementsByClassName('js-forum-topic-title--buttons')
    @editor = document.getElementsByClassName('js-forum-topic-title--editor')
    @input = document.getElementsByClassName('js-forum-topic-title--input')
    @main = document.getElementsByClassName('js-forum-topic-title--main')
    @padding = document.getElementsByClassName('js-forum-topic-title--padding')
    @saveButton = document.getElementsByClassName('js-forum-topic-title--save')
    @title = document.getElementsByClassName('js-forum-topic-title--title')

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
    @editHide()
    @input[0].value = @current()


  current: =>
    @title[0].textContent.trim()


  editShow: =>
    @editor[0].classList.remove 'hidden'
    @main[0].classList.add 'hidden'

    @input[0].style.paddingRight = "#{@buttons[0].getBoundingClientRect().width}px"
    @input[0].value = @current()
    @syncPadding()
    @input[0].selectionStart = @input[0].value.length
    @input[0].focus()


  editHide: =>
    @editor[0].classList.add 'hidden'
    @main[0].classList.remove 'hidden'


  onInput: =>
    @saveButton[0].disabled = !osu.presence(@input[0].value)?
    @syncPadding()


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

    return @cancel() if newTitle == @current()

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


  syncPadding: =>
    @padding[0].textContent = @input[0].value
