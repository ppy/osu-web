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

class @BeatmapPack
  @initialize: ->
    new BeatmapPack(elem) for elem in document.querySelectorAll('.js-beatmap-pack')

  constructor: (rootElement) ->
    @el = rootElement
    @packId = rootElement.dataset.packId
    @packBody = @el.querySelector('.js-accordion__item-body')
    @expander = @el.querySelector('.js-accordion__item-header')
    @busy = false
    @isCurrent = @el.classList.contains('js-accordion__item--expanded')

    $('.js-accordion').on 'beatmappack:clicked', @onClick
    $(@expander).on 'click', (event) =>
      event.preventDefault()
      $(@el).trigger 'beatmappack:clicked', @packId

  onClick: (e, id) =>
    e.stopPropagation()
    if @isCurrent || @packId != id
      @close()
    else
      @open()

  open: =>
    @isCurrent = true
    return if @busy

    @nextFrame =>
      $(@el).addClass('js-accordion__item--expanded')

    if @packBody.innerHTML?.length
      @slideDown() if @isCurrent
    else
      @busy = true
      @getBeatmapPackItem(@packId)
      .done (data) =>
        @nextFrame =>
          @packBody.innerHTML = data
          @slideDown() if @isCurrent

      .fail osu.ajaxError

      .always =>
        @busy = false

  close: =>
    return if !@isCurrent
    @isCurrent = false

    @nextFrame =>
      @packBody.style.height = '0'
      $(@el).removeClass('js-accordion__item--expanded')

  # TODO: move out.
  getBeatmapPackItem: (packId) ->
    $.get laroute.route('packs.raw', pack: packId)

  slideDown: =>
    @packBody.style.height = ''
    rect = @packBody.getBoundingClientRect()
    @packBody.style.height = '0'
    @nextFrame =>
      @packBody.style.height = "#{rect.height}px"

  nextFrame: (fn) ->
    window.requestAnimationFrame fn
