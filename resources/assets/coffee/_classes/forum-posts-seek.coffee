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
  tooltip: document.getElementsByClassName('js-forum-posts-seek--tooltip')
  tooltipNumber: document.getElementsByClassName('js-forum-posts-seek-tooltip-number')
  seekbar: document.getElementsByClassName('js-forum__posts-seek')


  constructor: (forum) ->
    @forum = forum
    $(document).on 'mousemove', '.js-forum__posts-seek', @move
    $(document).on 'mouseleave', '.js-forum__posts-seek', @hideTooltip
    $(document).on 'click', '.js-forum__posts-seek', @click

    $(document).on 'click', '.js-forum-posts-seek--jump', @jump


  hideTooltip: =>
    Fade.out @tooltip[0]

  move: (e) =>
    e.preventDefault()
    e.stopPropagation()

    @setPostPosition(e.clientX)

    Fade.in @tooltip[0]

    clearTimeout @_autohide
    @_autohide = setTimeout @hideTooltip, 1000


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


  setPostPosition: (x) =>

    full = @seekbar[0].offsetWidth
    position = x / full

    totalPosts = @forum.totalPosts()

    postPosition = Math.ceil(position * @forum.totalPosts())
    postPosition = Math.min(postPosition, totalPosts)
    @postPosition = Math.max(postPosition, 1)

    @tooltip[0].style.left = "#{x}px"
    @tooltipNumber[0].textContent = @postPosition
