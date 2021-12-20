# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.ForumTopicPostJump
  constructor: (@forum) ->
    $(document).on 'click', '.js-forum-topic-post-jump--cover', @start
    $(document).on 'blur', '.js-forum-topic-post-jump--input', @end
    $(document).on 'keyup', '.js-forum-topic-post-jump--input', @keyup
    $.subscribe 'forum:topic:jumpTo', @end


  end: =>
    $('.js-forum-topic-post-jump--container').removeClass('js-forum-topic-post-jump--container-focus')
    $('.js-forum-topic-post-jump--cover').show()
    $('.js-forum-topic-post-jump--counter').show()
    $('.js-forum-topic-post-jump--input').hide()


  keyup: (e) =>
    if e.keyCode == 27
      $(e.currentTarget).blur()
      return

    input = e.currentTarget
    value = input.value
    numericValue = value.replace(/\D/g, '')

    return if value == numericValue

    input.value = numericValue


  start: =>
    $('.js-forum-topic-post-jump--container').addClass('js-forum-topic-post-jump--container-focus')
    $('.js-forum-topic-post-jump--cover').hide()
    $('.js-forum-topic-post-jump--counter').hide()

    $input = $('.js-forum-topic-post-jump--input')
      .val(@forum.currentPostPosition)
      .show()
      .focus()

    $input[0].selectionStart = 0
    $input[0].selectionEnd = $input.val().length
