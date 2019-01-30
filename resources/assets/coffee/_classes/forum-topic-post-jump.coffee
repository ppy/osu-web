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

class @ForumTopicPostJump
  constructor: (@forum) ->
    $(document).on 'click', '.js-forum-topic-post-jump--cover', @start
    $(document).on 'blur', '.js-forum-topic-post-jump--input', @end
    $(document).on 'keyup', '.js-forum-topic-post-jump--input', @keyup
    $.subscribe 'forum:topic:jumpTo', @end


  end: =>
    $('.js-forum-topic-post-jump--container').removeClass('forum-topic-nav__item--focus')
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
    $('.js-forum-topic-post-jump--container').addClass('forum-topic-nav__item--focus')
    $('.js-forum-topic-post-jump--cover').hide()
    $('.js-forum-topic-post-jump--counter').hide()

    $input = $('.js-forum-topic-post-jump--input')
      .val(@forum.currentPostPosition)
      .show()
      .focus()

    $input[0].selectionStart = 0
    $input[0].selectionEnd = $input.val().length
