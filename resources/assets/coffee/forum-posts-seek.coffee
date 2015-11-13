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
class @ForumPostsSeek
  tooltip: document.getElementsByClassName('js-forum-posts-seek-tooltip')
  tooltipNumber: document.getElementsByClassName('js-forum-posts-seek-tooltip-number')
  seekbar: document.getElementsByClassName('js-forum__posts-seek')


  constructor: (forum) ->
    @forum = forum
    $(document).on 'mouseenter', '.js-forum__posts-seek', @enter
    $(document).on 'mouseleave touchend', '.js-forum__posts-seek', @leave
    $(document).on 'mousemove', '.js-forum__posts-seek', @move
    $(document).on 'click', '.js-forum__posts-seek', @click

    $(document).on 'click', '.js-forum-posts-seek--jump', @jump


  enter: (e) =>
    return if @tooltip[0]._visible

    @move(e)
    @tooltip[0]._visible = true
    fade.in @tooltip[0], 'flex'


  leave: (e) =>
    return unless @tooltip[0]._visible

    @tooltip[0]._visible = false
    fade.out @tooltip[0]


  move: (e) =>
    e.preventDefault()
    e.stopPropagation()
    seekbarPos = @seekbar[0].getBoundingClientRect()

    full = seekbarPos.width
    position = e.offsetX / full
    totalPosts = @forum.totalPosts()
    postPosition = Math.ceil(position * @forum.totalPosts())
    postPosition = Math.min(postPosition, totalPosts)
    @postPosition = Math.max(postPosition, 1)

    @tooltip[0].style.left = "#{e.pageX}px"
    @tooltip[0].style.bottom = seekbarPos.top
    @tooltipNumber[0].textContent = @postPosition


  click: =>
    @forum.jumpTo @postPosition

  jump: (e) =>
    e.preventDefault()

    currentPost = @forum.currentPostPosition
    totalPosts = @forum.totalPosts()
    $target = $(e.currentTarget)
    jumpTarget = $target.attr('data-jump-target')

    n = switch jumpTarget
      when 'first' then 1
      when 'last' then totalPosts
      when 'previous' then currentPost - 10
      when 'next' then currentPost + 10

    $target.blur()
    @forum.jumpTo n
