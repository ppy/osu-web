###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License version 3
as published by the Free Software Foundation.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
$(document).on 'ajax:success', '.delete-post-link', (_event, data) ->
  $el = $(".js-forum-post[data-post-id=#{data.postId}]")
  currentHeight = $el.css 'height'

  $el
    .css
      minHeight: '0px'
      height: currentHeight
    .slideUp null, ->
      $el.remove()

      window.forum.setTotalPosts(window.forum.totalPosts() - 1)

      for post in window.forum.posts by -1
        originalPosition = parseInt post.getAttribute('data-post-position'), 10

        break if originalPosition < data.postPosition

        post.setAttribute 'data-post-position', originalPosition - 1

      osu.pageChange()


$(document).on 'ajax:success', '.edit-post-link', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early because the link (target) is
  # removed in this callback.
  $(e.target).trigger('ajax:complete', [xhr, status])

  $postBox = $(e.target).parents('.js-forum-post')

  $postBox
    .data 'originalPost', $postBox.html()
    .html data
    .find '[name=body]'
    .focus()

  osu.pageChange()


$(document).on 'click', '.js-edit-post-cancel', (e) ->
  e.preventDefault()

  $postBox = $(e.target).parents '.js-forum-post'
  $postBox.html $postBox.data('originalPost')

  osu.pageChange()


$(document).on 'ajax:success', '.js-forum-post-edit', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early since the form (target) is
  # removed in this callback.
  $(e.target)
    .trigger('ajax:complete', [xhr, status])
    .parents('.js-forum-post').replaceWith(data)

  osu.pageChange()
