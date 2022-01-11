# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { fadeIn, fadeOut } from 'utils/fade'

class window.ForumPostsSeek
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

    fadeOut @tooltip[0]


  move: (e) =>
    e.preventDefault()
    e.stopPropagation()

    @setPostPosition(e.clientX)

    fadeIn @tooltip[0]

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
