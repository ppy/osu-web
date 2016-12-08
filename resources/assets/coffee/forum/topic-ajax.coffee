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
$(document).on 'ajax:success', '.delete-post-link', (event, data, status, xhr) ->
  $el = $(".js-forum-post[data-post-id=#{data.postId}]")

  toggle = event.target
  action = toggle.getAttribute 'data-action'

  if currentUser.isAdmin || currentUser.isGMT
    $post = $el.find '.forum-post'

    switch action
      when 'delete'
        $post.addClass 'forum-post--hidden'
      when 'undelete'
        $post.removeClass 'forum-post--hidden'

    # need to trigger ajax:complete early
    $(toggle)
      .trigger('ajax:complete', [xhr, status])
      .parent().replaceWith(data.toggle)
  else
    $el
      .css
        minHeight: '0px'
        height: $el.css 'height'
      .slideUp null, ->
        $el.remove()

  countDifference = if action == 'delete' then -1 else 1

  window.forum.setTotalPosts window.forum.totalPosts() + countDifference

  for post in window.forum.posts by -1
    originalPosition = parseInt post.getAttribute('data-post-position'), 10

    break if originalPosition < data.postPosition

    post.setAttribute 'data-post-position', originalPosition + countDifference

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
