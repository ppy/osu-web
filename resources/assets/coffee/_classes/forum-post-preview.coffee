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
