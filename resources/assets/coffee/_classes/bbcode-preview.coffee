# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @BbcodePreview
  constructor: ->
    $(document).on 'click', '.js-bbcode-preview--show', @fetchPreview
    $(document).on 'click', '.js-bbcode-preview--hide', @hidePreview


  fetchPreview: (e) =>
    target = e.target
    $form = $(target).parents('.js-bbcode-preview--form')
    $preview = $form.find('.js-bbcode-preview--preview')
    $body = $form.find('.js-bbcode-preview--body')

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
      _exported.pageChange()
      @showPreview(e)

    .fail osu.emitAjaxError(target)


  showPreview: (e) =>
    $(e.target).parents('.js-bbcode-preview--form').attr('data-state', 'preview')
    _exported.pageChange() # sync height of reply box


  hidePreview: (e) =>
    $form = $(e.target).parents('.js-bbcode-preview--form')
    $form.attr('data-state', 'write')
    _exported.pageChange() # sync height of reply box

    $form.find('.js-bbcode-preview--body').focus()
