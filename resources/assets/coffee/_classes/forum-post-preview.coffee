# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @ForumPostPreview
  constructor: ->
    $(document).on 'click', '.js-forum-post-preview--show', @fetchPreview
    $(document).on 'click', '.js-forum-post-preview--hide', @hidePreview


  fetchPreview: (e) =>
    $form = $(e.target).parents('.js-forum-post-preview--form')
    $preview = $form.find('.js-forum-post-preview--preview')
    $body = $form.find('.js-forum-post-preview--body')

    text = $body.val()
    lastText = $body.attr('data-last-text')

    return if $form.attr('data-state') == 'preview'

    return unless osu.present(text)

    if text == $body.attr('data-last-text')
      @showPreview(e)
      return

    $form.attr('data-state', 'loading-preview')

    $.ajax
      url: laroute.route 'bbcode-preview'
      method: 'POST'
      data: { text }

    .done (data) =>
      $body.attr('data-last-text', text)

      $preview.html(data)
      osu.pageChange()
      @showPreview(e)


  showPreview: (e) =>
    $(e.target).parents('.js-forum-post-preview--form').attr('data-state', 'preview')
    osu.pageChange() # sync height of reply box


  hidePreview: (e) =>
    $form = $(e.target).parents('.js-forum-post-preview--form')
    $form.attr('data-state', 'write')
    osu.pageChange() # sync height of reply box

    $form.find('.js-forum-post-preview--body').focus()
