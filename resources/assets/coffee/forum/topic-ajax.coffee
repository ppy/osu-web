###
Copyright 2015 ppy Pty. Ltd.

This file is part of osu!web. osu!web is distributed with the hope of
attracting more community contributions to the core ecosystem of osu!.

osu!web is free software: you can redistribute it and/or modify
it under the terms of the Affero GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
$(document).on 'ajax:success', '.delete-post-link', (_event, data) ->
  $el = $(".forum-post[data-post-id=#{data.postId}]")
  currentHeight = $el.css 'height'

  $el
    .css
      minHeight: '0px'
      height: currentHeight
    .removeClass 'js-forum-post__shrunk'
    .slideUp null, ->
      $el.remove()

      window.forum.setTotalPosts(window.forum.totalPosts() - 1)

      for post in window.forum.posts by -1
        originalPosition = parseInt post.getAttribute('data-post-position'), 10

        break if originalPosition < data.postPosition

        post.setAttribute 'data-post-position', originalPosition - 1

      $(document).trigger('osu:page:change')


$(document).on 'ajax:before', '.reply-post-link', (e, data) ->
  if window.isDoublePost
    url = location.href
    history.replaceState(null, null, url)
    location.href = "#doublepost-box"
    return false
  return true

$(document).on 'ajax:success', '.reply-post-link', (e, data) ->
  data += '\n'

  $replyBox = $('#forum-topic-reply-box')
  $replyInput = $replyBox.find('[name=body]')
  $postRow = $(e.target).parents('.forum-post')

  currentInput = $replyInput.val()
  data = "#{currentInput}\n\n#{data}" if currentInput != ''

  $replyBox.insertAfter($postRow).css(zIndex: 1).show()

  $replyInput.val(data).focus()
  $replyInput[0].selectionStart = $replyInput.val().length


$(document).on 'ajax:success', '#forum-topic-reply-box', (_event, data) ->
  if window.forum.lastPostLoaded()
    window.forum.setTotalPosts(window.forum.totalPosts() + 1)
    window.forum.endPost().insertAdjacentHTML('afterend', data)

    $('#forum-topic-reply-box')
      .insertAfter($('.forum-post').last())
      .find('textarea').val('')

    $(document).trigger('osu:page:change')

    newPost = window.forum.endPost()
    newPost.classList.remove('js-forum-post__shrunk')
    newPost.scrollIntoView()
    window.isDoublePost = true

    $('#forum-topic-reply-box').hide()

    doublepostBox = $("#doublepost-box")
    editLastPostLink = doublepostBox.find("a.edit-post-link")
    lastPostId = $(".forum-post").last().attr("data-post-id")
    previousLastPostId = editLastPostLink.attr("data-target-post-id")

    editLastPostLink.attr("href", editLastPostLink.attr("href").replace(previousLastPostId, lastPostId))
    editLastPostLink.attr("data-target-post-id", lastPostId)
    doublepostBox.show()

  else
    osu.navigate $(data).find('.js-post-url').attr('href')


$(document).on 'ajax:success', '.edit-post-link', (e, data, status, xhr) ->
  targetId = $(e.target).attr("data-target-post-id")
  $postBox = $("[data-post-id='#{targetId}']")

  # ajax:complete needs to be triggered early because the link (target) is
  # removed in this callback.
  $(e.target).trigger('ajax:complete', [xhr, status])

  $postBox
    .data 'originalPost', $postBox.html()
    .html data
    .find '[name=body]'
    .focus()

  $(document).trigger('osu:page:change')


$(document).on 'click', '.js-edit-post-cancel', (e) ->
  e.preventDefault()

  $postBox = $(e.target).parents '.forum-post'
  $postBox.html $postBox.data('originalPost')

  $(document).trigger('osu:page:change')


$(document).on 'ajax:success', '.edit-post', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early since the form (target) is
  # removed in this callback.
  $(e.target)
    .trigger('ajax:complete', [xhr, status])
    .parents('.forum-post').replaceWith(data)

  $(document).trigger('osu:page:change')
