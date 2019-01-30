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

class @PostPreview
  constructor: ->
    @debouncedLoadPreview = _.debounce @loadPreview, 500

    $(document).on 'input', '.js-post-preview--auto', (e) =>
      # get the target immediately because event object may change later.
      @debouncedLoadPreview(e.currentTarget)


  loadPreview: (target) =>
    $form = $(target).closest('form')
    url = laroute.route('bbcode-preview')
    body = target.value
    $preview = $form.find('.js-post-preview--body')
    $previewBox = $form.find('.js-post-preview--box')

    return if $preview.attr('data-raw') == body

    $.post(url, text: body)
    .done (data) =>
      $preview.html data
      $preview.attr 'data-raw', body
      $previewBox.removeClass 'hidden'
      osu.pageChange()
