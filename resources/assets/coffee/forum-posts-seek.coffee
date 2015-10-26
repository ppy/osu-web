###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
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
    $(document).on 'mouseleave', '.js-forum__posts-seek', @leave
    $(document).on 'mousemove', '.js-forum__posts-seek', @move
    $(document).on 'click', '.js-forum__posts-seek', @click

    $(document).on 'click', '.js-forum-posts-seek--jump', @jump


  enter: (e) =>
    @move(e)
    fade.in @tooltip[0], 'flex'


  leave: (e) =>
    fade.out @tooltip[0]



  move: (e) =>
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
    target = $(e.currentTarget).attr('data-jump-target')

    n = switch target
      when 'first' then 1
      when 'last' then @forum.totalPosts()
      when 'previous' then currentPost - 10
      when 'next' then currentPost + 10

    @forum.jumpTo n
