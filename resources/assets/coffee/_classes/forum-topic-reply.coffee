# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { currentUrl } from 'utils/turbolinks'

class window.ForumTopicReply
  constructor: ({ @bbcodePreview, @forum, @stickyFooter }) ->
    @container = document.getElementsByClassName('js-forum-topic-reply--container')
    @box = document.getElementsByClassName('js-forum-topic-reply')
    @block = document.getElementsByClassName('js-forum-topic-reply--block')
    @input = document.getElementsByClassName('js-forum-topic-reply--input')
    @toggleButtons = document.getElementsByClassName('js-forum-topic-reply--toggle')
    @fixedBar = document.getElementsByClassName('js-sticky-footer--fixed-bar')

    $(document).on 'ajax:success', '.js-forum-topic-reply', @posted

    $(document).on 'click', '.js-forum-topic-reply--deactivate', @toggleDeactivate
    $(document).on 'click', '.js-forum-topic-reply--toggle', @toggle
    $(document).on 'ajax:success', '.js-forum-topic-reply--quote', @activateWithReply

    $(document).on 'focus', '.js-forum-topic-reply--input', @activate

    $.subscribe 'stickyFooter', @stickOrUnstick

    $(document).on 'turbolinks:load', @initialize


  marker: -> document.querySelector('.js-sticky-footer[data-sticky-footer-target="forum-topic-reply"]')

  $input: -> $('.js-forum-topic-reply--input')

  initialize: =>
    return unless @available()

    @deleteState 'sticking'
    @activate() if @getState('active') == '1'


  available: => @block.length


  deleteState: (key) =>
    localStorage.removeItem "forum-topic-reply--#{currentUrl().pathname}--#{key}"


  getState: (key) =>
    localStorage.getItem "forum-topic-reply--#{currentUrl().pathname}--#{key}"


  setState: (key, value) =>
    localStorage.setItem "forum-topic-reply--#{currentUrl().pathname}--#{key}", value


  activate: =>
    @setState 'active', '1'

    @stickyFooter.markerEnable @marker()
    $.publish 'stickyFooter:check'

    button.classList.add 'js-activated' for button in @toggleButtons

    @enableFlash() if @getState('sticking') != '1' && currentUser.id?

    Timeout.set 0, => @input[0].focus()


  activateWithReply: (e, data) =>
    data += '\n'

    $input = @$input()

    currentInput = $input.val()
    data = "#{currentInput}\n\n#{data}" if currentInput

    $input.val(data).trigger('input')
    $input[0].selectionStart = data.length

    @activate()


  deactivate: =>
    @stickyFooter.markerDisable @marker()
    @setState 'active', '0'
    $.publish 'stickyFooter:check'
    @disableFlash()
    button.classList.remove 'js-activated' for button in @toggleButtons


  disableFlash: ->
    $('.js-forum-topic-reply').removeClass('js-forum-topic-reply-flash')


  enableFlash: =>
    $('.js-forum-topic-reply').addClass('js-forum-topic-reply-flash')
    Timeout.set 500, @disableFlash # so animation doesn't play again when element gets transplanted from unsticking.


  posted: (e, data) =>
    input = @input[0]

    @deactivate()
    input.value = ''
    @bbcodePreview.hidePreview(target: input)

    $newPost = $(data)

    needReload = (@forum.postPosition($newPost[0]) - 1) != @forum.postPosition(@forum.endPost()) ||
      e.target.dataset.forceReload == '1'

    if needReload
      osu.navigate $newPost.find('.js-post-url').attr('href')
    else
      @forum.setTotalPosts(@forum.totalPosts() + 1)
      @forum.endPost().insertAdjacentHTML 'afterend', data
      _exported.pageChange()

      @forum.endPost().scrollIntoView()


  stickOrUnstick: (_e, target) =>
    stick =
      if osuCore.windowSize.isDesktop
        target == 'forum-topic-reply'
      else
        @getState('active') == '1'

    @toggleStick(stick)


  toggle: =>
    if @getState('active') == '1'
      @deactivate()
    else
      @activate()


  toggleDeactivate: (e) =>
    # prevent reactivation if the button is located inside the form
    e.stopPropagation()
    @deactivate()


  toggleStick: (stick) =>
    isSticking = @getState('sticking') == '1'

    document.body.style.overflow =
      if !stick || osuCore.windowSize.isDesktop
        ''
      else
        'hidden'

    return if stick == isSticking

    box = @box[0]

    if stick
      @setState 'sticking', '1'
      box.dataset.state = 'stick'
      target = @fixedBar[0]
    else
      @deleteState 'sticking'
      delete box.dataset.state if box.dataset.state?
      target = @container[0]

    $input = @$input()
    inputFocused = $input.is(':focus')

    target.insertBefore(box, target.firstChild)

    $input.focus() if inputFocused
    _exported.pageChange() # sync reply box height
