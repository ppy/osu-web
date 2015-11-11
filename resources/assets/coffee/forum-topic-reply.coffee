###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class @ForumTopicReply
  $box: -> $('.js-forum-topic-reply')
  $input: -> $('.js-forum-topic-reply--input')

  constructor: (forum) ->
    @forum = forum
    $(document).on 'ajax:success', '.js-forum-topic-reply--quote', @showWithReply
    $(document).on 'ajax:success', '.js-forum-topic-reply', @posted
    $(document).on 'click', '.js-forum-topic-reply--close', @hide
    $(document).on 'click', '.js-forum-topic-reply--new', @show


  hide: (e) =>
    e.preventDefault() if e

    fade.out @$box()[0], -> $.publish('fixedBottomBar:update')


  show: (e) =>
    e.preventDefault() if e

    fade.in @$box()[0], null, =>
      $.publish('fixedBottomBar:update')
      @$input().focus()


  showWithReply: (e, data) =>
    data += '\n'

    $input = @$input()

    currentInput = $input.val()
    data = "#{currentInput}\n\n#{data}" if currentInput

    $input.val(data)
    $input[0].selectionStart = data.length

    @show()


  posted: (_e, data) =>
    @hide()
    @$input().val ''

    if @forum.lastPostLoaded()
      @forum.setTotalPosts(@forum.totalPosts() + 1)
      @forum.endPost().insertAdjacentHTML 'afterend', data
      osu.pageChange()

      @forum.endPost().scrollIntoView()
    else
      osu.navigate $(data).find('.js-post-url').attr('href')
