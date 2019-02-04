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

class @ReplyPreview
  constructor: ->
    @input = '.js-forum-topic-reply--input'

    @writeButton = '.js-forum-reply-preview--hide'
    @previewButton = '.js-forum-reply-preview--show'

    @editBox = '.js-forum-reply-write'
    @previewBox = '.js-forum-reply-preview'

    @lastBody = null

    $(document).on 'click', '.js-forum-reply-preview--show', @fetchPreview
    $(document).on 'click', '.js-forum-reply-preview--hide', @hidePreview

    $(document).on 'turbolinks:load', @resetPreview


  fetchPreview: (e) =>
    e.preventDefault()
    $preview = $(@previewBox).find('.js-forum-reply-preview--content')
    url = laroute.route 'bbcode-preview'
    body = $(@input).val()

    return if $(@previewButton).hasClass 'active'

    if body == @lastBody
      @showPreview()
      return

    $.ajax
      url: url
      method: 'POST'
      data:
        text: body

    .done (data) =>
      @lastBody = body

      $preview.html(data)
      @showPreview()


  showPreview: =>
    $(@editBox).addClass 'hidden'
    $(@previewBox).removeClass 'hidden'

    $(@previewButton).addClass 'js-is-active'
    $(@writeButton).removeClass 'js-is-active'

    osu.pageChange()

  hidePreview: (e) =>
    e?.preventDefault()

    $(@editBox).removeClass 'hidden'
    $(@previewBox).addClass 'hidden'

    $(@previewButton).removeClass 'js-is-active'
    $(@writeButton).addClass 'js-is-active'

    osu.pageChange()

  resetPreview: =>
    @lastBody = null
