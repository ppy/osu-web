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

class @ForumPostsSeek
  constructor: (@forum) ->
    @tooltip = document.getElementsByClassName('js-forum-posts-seek--tooltip')
    @tooltipNumber = document.getElementsByClassName('js-forum-posts-seek-tooltip-number')
    @seekbar = document.getElementsByClassName('js-forum__posts-seek')

    $(document).on 'mousemove', '.js-forum__posts-seek', @move
    $(document).on 'mouseleave', '.js-forum__posts-seek', @hideTooltip
    $(document).on 'click', '.js-forum__posts-seek', @click

    $(document).on 'click', '.js-forum-posts-seek--jump', @jump

    addEventListener 'turbolinks:before-cache', @reset


  hideTooltip: =>
    return if @tooltip.length == 0

    Fade.out @tooltip[0]


  move: (e) =>
    e.preventDefault()
    e.stopPropagation()

    @setPostPosition(e.clientX)

    Fade.in @tooltip[0]

    Timeout.clear @_autohide
    @_autohide = Timeout.set 1000, @hideTooltip


  click: =>
    @forum.jumpTo @postPosition


  jump: (e) =>
    e.preventDefault()

    currentPost = @forum.currentPostPosition
    totalPosts = @forum.totalPosts()
    $target = $(e.currentTarget)
    jumpTarget = $target.attr('data-jump-target')

    n = switch jumpTarget
      when 'first'
        1
      when 'last'
        totalPosts
      when 'previous'
        defaultN = currentPost - 10
        # avoid jumping beyond loaded posts
        minLoadedN = @forum.postPosition @forum.posts[0]
        Math.max(defaultN, minLoadedN)
      when 'next'
        defaultN = currentPost + 10
        # avoid jumping beyond loaded posts
        maxLoadedN = @forum.postPosition @forum.endPost()
        Math.min(defaultN, maxLoadedN)

    $target.blur()
    @forum.jumpTo n


  reset: =>
    Timeout.clear @_autohide
    @hideTooltip()


  setPostPosition: (x) =>

    full = @seekbar[0].offsetWidth
    position = x / full

    totalPosts = @forum.totalPosts()

    postPosition = Math.ceil(position * @forum.totalPosts())
    postPosition = Math.min(postPosition, totalPosts)
    @postPosition = Math.max(postPosition, 1)

    @tooltip[0].style.transform = "translateX(#{x}px)"
    @tooltipNumber[0].textContent = @postPosition
