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

class @ForumTopicReply
  constructor: (@forum) ->
    @container = document.getElementsByClassName('js-forum-topic-reply--container')
    @box = document.getElementsByClassName('js-forum-topic-reply')
    @block = document.getElementsByClassName('js-forum-topic-reply--block')
    @input = document.getElementsByClassName('js-forum-topic-reply--input')
    @toggleButtons = document.getElementsByClassName('js-forum-topic-reply--toggle')
    @fixedBar = document.getElementsByClassName('js-sticky-footer--fixed-bar')

    $(document).on 'ajax:success', '.js-forum-topic-reply', @posted

    $(document).on 'click', '.js-forum-topic-reply--toggle', @toggle
    $(document).on 'click', '.js-forum-topic-reply--deactivate', @toggleDeactivate
    $(document).on 'ajax:success', '.js-forum-topic-reply--quote', @activateWithReply

    $(document).on 'focus', '.js-forum-topic-reply--input', @activate
    $(document).on 'input change', '.js-forum-topic-reply--input', _.debounce(@inputChange, 500)

    $(document).on 'turbolinks:load', @initialize


  $input: -> $('.js-forum-topic-reply--input')

  initialize: =>
    return unless @available()

    @input[0].value = @getState('text') ? ''
    @activate(null, true) if @getState('active') == '1'


  available: => @block.length


  deleteState: (key) =>
    localStorage.removeItem "forum-topic-reply--#{document.location.pathname}--#{key}"


  getState: (key) =>
    localStorage.getItem "forum-topic-reply--#{document.location.pathname}--#{key}"


  setState: (key, value) =>
    localStorage.setItem "forum-topic-reply--#{document.location.pathname}--#{key}", value


  activate: (_e, force) =>
    force ?= false

    return if !force && @getState('active') == '1'

    @setState 'active', '1'
    button.classList.add 'js-activated' for button in @toggleButtons

    @fixedBar[0].insertBefore(@box[0], @fixedBar[0].firstChild)
    @box[0].dataset.state = 'active'
    @enableFlash()

    # doesn't work on firefox without timeout
    Timeout.set 0, => @$input().focus()


  activateWithReply: (e, data) =>
    data += '\n'

    $input = @$input()

    currentInput = $input.val()
    data = "#{currentInput}\n\n#{data}" if currentInput

    $input.val(data)
    @inputChange()
    $input[0].selectionStart = data.length

    @activate(e)


  deactivate: (e) =>
    e.preventDefault() if e

    @setState 'active', '0'
    button.classList.remove 'js-activated' for button in @toggleButtons
    @container[0].insertBefore(@box[0], @container[0].firstChild)
    delete @box[0].dataset.state if @box[0].dataset.state?
    @disableFlash()


  disableFlash: ->
    $('.js-forum-topic-reply').removeClass('js-forum-topic-reply-flash')


  enableFlash: =>
    $('.js-forum-topic-reply').addClass('js-forum-topic-reply-flash')
    Timeout.set 500, @disableFlash


  inputChange: =>
    @setState 'text', @input[0].value


  posted: (e, data) =>
    @deactivate()
    @$input().val ''
    @setState 'text', ''

    $newPost = $(data)

    needReload = (@forum.postPosition($newPost[0]) - 1) != @forum.postPosition(@forum.endPost()) ||
      e.target.dataset.forceReload == '1'

    if needReload
      osu.navigate $newPost.find('.js-post-url').attr('href')
    else
      @forum.setTotalPosts(@forum.totalPosts() + 1)
      @forum.endPost().insertAdjacentHTML 'afterend', data
      osu.pageChange()

      @forum.endPost().scrollIntoView()


  toggle: =>
    if @getState('active') == '1'
      @deactivate()
    else
      @activate()


  toggleDeactivate: (e) =>
    e.preventDefault()
    e.stopPropagation()
    @deactivate()
