# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.


$(document).on 'ajax:success', '.js-edit-post-start', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early because the link (target) is
  # removed in this callback.
  $(e.target).trigger('ajax:complete', [xhr, status])

  $postBox = $(e.target).parents('.js-forum-post-edit--container')

  $postBox
    .attr 'data-original-post', $postBox.html()
    .html data
    .find '[name=body]'
    .focus()

  osu.pageChange()


$(document).on 'click', '.js-edit-post-cancel', (e) ->
  e.preventDefault()

  $postBox = $(e.target).parents '.js-forum-post-edit--container'
  $postBox
    .html $postBox.attr('data-original-post')
    .attr 'data-original-post', null

  osu.pageChange()


$(document).on 'ajax:success', '.js-forum-post-edit', (e, data, status, xhr) ->
  # ajax:complete needs to be triggered early since the form (target) is
  # removed in this callback.
  $(e.target)
    .trigger('ajax:complete', [xhr, status])
    .parents('.js-forum-post').replaceWith(data)

  osu.pageChange()
