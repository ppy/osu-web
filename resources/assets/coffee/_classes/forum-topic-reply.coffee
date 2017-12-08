###
#    Copyright 2015-2017 ppy Pty. Ltd.
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
  constructor: (@forum, @stickyFooter) ->
    @container = document.getElementsByClassName('js-forum-topic-reply--container')
    @box = document.getElementsByClassName('js-forum-topic-reply')
    @input = document.getElementsByClassName('js-forum-topic-reply--input')
    @stickButtons = document.getElementsByClassName('js-forum-topic-reply--stick')
    @fixedBar = document.getElementsByClassName('js-sticky-footer--fixed-bar')

    $(document).on 'ajax:success', '.js-forum-topic-reply', @posted

    $(document).on 'click', '.js-forum-topic-reply--stick', @toggle
    $(document).on 'ajax:success', '.js-forum-topic-reply--quote', @activateWithReply

    $(document).on 'focus', '.js-forum-topic-reply--input', @activate
    $(document).on 'input change', '.js-forum-topic-reply--input', _.debounce(@inputChange, 500)

    $.subscribe 'stickyFooter', @stickOrUnstick

    $(document).on 'turbolinks:load', @initialize


  marker: -> document.querySelector('.js-sticky-footer[data-sticky-footer-target="forum-topic-reply"]')

  $input: -> $('.js-forum-topic-reply--input')

  initialize: =>
    return unless @available()

    @deleteState 'sticking'
    @input[0].value = @getState('text') || ''
    @activate() if @getState('active') == '1'


  available: => @box.length


  deleteState: (key) =>
    localStorage.removeItem "forum-topic-reply--#{document.location.pathname}--#{key}"


  getState: (key) =>
    localStorage.getItem "forum-topic-reply--#{document.location.pathname}--#{key}"


  setState: (key, value) =>
    localStorage.setItem "forum-topic-reply--#{document.location.pathname}--#{key}", value


  activate: (e) =>
    e.preventDefault() if e

    @setState 'active', '1'
    button.classList.add 'js-activated' for button in @stickButtons

    @stickyFooter.markerEnable @marker()
    $.publish 'stickyFooter:check'


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

    @stickyFooter.markerDisable @marker()
    @setState 'active', '0'
    button.classList.remove 'js-activated' for button in @stickButtons
    $.publish 'stickyFooter:check'


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


  stick: =>
    return if @getState('sticking') == '1'

    @setState 'sticking', '1'

    $input = @$input()
    inputFocused = $input.is(':focus')

    @fixedBar[0].insertBefore(@box[0], @fixedBar[0].firstChild)

    $input.focus() if inputFocused


  unstick: (e) =>
    return unless @getState('sticking') == '1'

    @deleteState 'sticking'

    @container[0].insertBefore(@box[0], @container[0].firstChild)


  stickOrUnstick: (_e, target) =>
    if target == 'forum-topic-reply'
      @stick()
    else
      @unstick()


  toggle: =>
    if @getState('active') == '1'
      @deactivate()
    else
      @activate()
      @$input().focus()
