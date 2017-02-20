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
    @closeButton = document.getElementsByClassName('js-forum-topic-reply--close')
    @fixedBar = document.getElementsByClassName('js-sticky-footer--fixed-bar')

    @writeButton = document.getElementsByClassName('js-forum-reply-preview--hide')
    @previewButton = document.getElementsByClassName('js-forum-reply-preview--show')

    @editBox = document.getElementsByClassName('js-forum-reply-write')
    @previewBox = document.getElementsByClassName('js-forum-reply-preview')

    @lastBody = null

    $(document).on 'ajax:success', '.js-forum-topic-reply', @posted

    $(document).on 'click', '.js-forum-reply-preview--show', @fetchPreview
    $(document).on 'click', '.js-forum-reply-preview--hide', @hidePreview

    $(document).on 'click', '.js-forum-topic-reply--close', @deactivate
    $(document).on 'click', '.js-forum-topic-reply--new', @activate
    $(document).on 'ajax:success', '.js-forum-topic-reply--quote', @activateWithReply

    $(document).on 'focus', '.js-forum-topic-reply--input', @activate
    $(document).on 'input change', '.js-forum-topic-reply--input', _.debounce(@inputChange, 500)
    $(document).on 'click', @deactivateIfBlank

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
    $.publish 'stickyFooter:check'


  deactivateIfBlank: (e) =>
    return unless @available() &&
      @getState('active') == '1' &&
      @input[0].value == ''

    $target = $(e.target)

    return unless $target.closest('.js-forum-topic-reply').length == 0 &&
        $target.closest('.js-forum-topic-reply--new').length == 0

    @deactivate()


  inputChange: =>
    @setState 'text', @input[0].value


  fetchPreview: =>
    $button = $(@previewButton)
    url = $button.attr 'data-preview-url'

    $input = $(@input)
    body = $input.val()

    $preview = $(@previewBox)

    return if $button.hasClass('active')

    if @lastBody == body
      @showPreview()
      return

    $.ajax
      url: url
      method: 'POST'
      data:
        body: body

    .done (data) =>
      @lastBody = body

      $preview.html(data)
      @showPreview()


  showPreview: =>
    $(@editBox).addClass('hidden')
    $(@previewBox).removeClass('hidden')

    $(@previewButton).addClass('active')
    $(@writeButton).removeClass('active')

    osu.pageChange()

  hidePreview: =>
    return if $(@writeButton).hasClass('active')

    $(@editBox).removeClass('hidden')
    $(@previewBox).addClass('hidden')

    $(@previewButton).removeClass('active')
    $(@writeButton).addClass('active')

    osu.pageChange()


  posted: (e, data) =>
    @deactivate()
    @$input().val ''
    @setState 'text', ''

    $newPost = $(data)

    needReload = (@forum.postPosition($newPost[0]) - 1) != @forum.postPosition(@forum.endPost()) ||
      e.target.dataset.forceReload == '1'

    @invalidatePreview()

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
    @closeButton[0].classList.remove 'hidden'

    $input.focus() if inputFocused


  unstick: (e) =>
    return unless @getState('sticking') == '1'

    @deleteState 'sticking'

    @container[0].insertBefore(@box[0], @container[0].firstChild)
    @closeButton[0].classList.add 'hidden'


  stickOrUnstick: (_e, target) =>
    if target == 'forum-topic-reply'
      @stick()
    else
      @unstick()
