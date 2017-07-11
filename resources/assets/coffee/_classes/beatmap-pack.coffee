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
    @linkElement = @el.querySelector('.js-beatmap-pack-link')
    @opened = false
    $(@linkElement).on 'click', (event) =>
      event.preventDefault()
      @toggle()

  toggle: =>
    if @opened then @close() else @open()

  open: =>
    return if @opened
    @opened = true

    if @packItemsElement.innerHTML?.length
      @slideDown()
    else
      @getBeatmapPackItem(@packId)
      .done (data) =>
        @packItemsElement.innerHTML = data
        @slideDown()
      .fail (xhr) =>
        console.log(xhr)

  close: =>
    return unless @opened
    @opened = false
    @slideUp()

  # TODO: move out.
  getBeatmapPackItem: (packId) ->
    $.get laroute.route('beatmappacks.show', beatmappack: packId)

  slideDown: =>
    $(@packItemsElement).slideDown(300, () =>
      $(@packItemsElement).removeClass('js-beatmap-pack__items--collapsed')
    )

  slideUp: =>
    $(@packItemsElement).slideUp(300, () =>
      $(@packItemsElement).addClass('js-beatmap-pack__items--collapsed')
    )

$(document).on 'turbolinks:load', ->
  BeatmapPack.initialize()
