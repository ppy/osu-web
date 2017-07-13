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
    @packItemsElement = @el.querySelector('.js-beatmap-pack__items')
    @expander = @el.querySelector('.js-beatmap-pack-expander')
    @busy = false

    $.subscribe 'beatmappack:clicked', @onClick
    $(@expander).on 'click', (event) =>
      event.preventDefault()
      $.publish 'beatmappack:clicked', @packId

  onClick: (_e, id) =>
    if @packId == id
      @open()
    else
      @close()

  open: =>
    return if @busy

    $(@el).addClass('accordion__item--expanded')
    if @packItemsElement.innerHTML?.length
      @slideDown()
    else
      @busy = true
      @packItemsElement.innerHTML = 'Loading...'
      @getBeatmapPackItem(@packId)
      .done (data) =>
        @packItemsElement.innerHTML = data
        @slideDown()
      .fail (xhr) ->
        console.error(xhr)
      .always =>
        @busy = false

  close: =>
    # drop shadow should change _after_ slide up animation
    $(@el.querySelector('.accordion__item-body')).slideUp(300, () =>
      $(@el).removeClass('accordion__item--expanded')
    )

  # TODO: move out.
  getBeatmapPackItem: (packId) ->
    $.get laroute.route('beatmappacks.show', beatmappack: packId)

  slideDown: =>
    $(@el.querySelector('.accordion__item-body')).slideDown(300)

$(document).on 'turbolinks:load', ->
  BeatmapPack.initialize()
