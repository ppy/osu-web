# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.PostPreview
  constructor: ->
    @debouncedLoadPreview = _.debounce @loadPreview, 500

    $(document).on 'input', '.js-post-preview--auto', (e) =>
      # get the target immediately because event object may change later.
      @debouncedLoadPreview(e.currentTarget)


  loadPreview: (target) =>
    $form = $(target).closest('form')
    body = target.value
    $preview = $form.find('.js-post-preview--preview')
    preview = $preview[0]
    $previewBox = $form.find('.js-post-preview--box')

    if !preview?
      return

    preview._xhr?.abort()

    if body == ''
      $previewBox.addClass 'hidden'
      return

    if $preview.attr('data-raw') == body
      $previewBox.removeClass 'hidden'
      return

    preview._xhr = $.post(laroute.route('bbcode-preview'), text: body)
    .done (data) =>
      $preview.html data
      $preview.attr 'data-raw', body
      $previewBox.removeClass 'hidden'
      _exported.pageChange()
