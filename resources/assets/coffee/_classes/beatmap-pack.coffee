###
#    Copyright 2015-2017 ppy Pty. Ltd.
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

class @BeatmapPack
  @initialize: ->
    new BeatmapPack(elem) for elem in document.querySelectorAll('.js-beatmap-pack')

  constructor: (rootElement) ->
    @el = rootElement
    @packId = rootElement.dataset.packId
    @packBody = @el.querySelector('.js-accordion__item-body')
    @expander = @el.querySelector('.js-accordion__item-header')
    @busy = false
    @isCurrent = false

    $.subscribe 'beatmappack:clicked', @onClick
    $(@expander).on 'click', (event) =>
      $.publish 'beatmappack:clicked', @packId

  onClick: (_e, id) =>
    if @packId == id
      @open()
    else
      @close()

  open: =>
    @isCurrent = true
    return if @busy

    $(@el).addClass('js-accordion__item--expanded')
    if @packBody.innerHTML?.length
      @slideDown() if @isCurrent
    else
      @busy = true
      @getBeatmapPackItem(@packId)
      .done (data) =>
        @packBody.innerHTML = data
        @slideDown() if @isCurrent
      .fail (xhr) ->
        console.error(xhr)
      .always =>
        @busy = false

  close: =>
    @isCurrent = false
    # drop shadow should change _after_ slide up animation
    $(@packBody).slideUp(300, () =>
      $(@el).removeClass('js-accordion__item--expanded')
    )

  # TODO: move out.
  getBeatmapPackItem: (packId) ->
    $.get laroute.route('beatmappacks.show', beatmappack: packId)

  slideDown: =>
    $(@packBody).slideDown(300)
