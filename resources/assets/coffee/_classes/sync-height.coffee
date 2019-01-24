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

class @SyncHeight
  constructor: ->
    @targets = document.getElementsByClassName('js-sync-height--target')
    @references = document.getElementsByClassName('js-sync-height--reference')

    $(document).on 'turbolinks:load osu:page:change', @sync
    $(window).on 'throttled-resize', @sync

    @observe()

  observe: =>
    config =
      attributes: true
      subtree: true

    @observer = new MutationObserver(@onResize)
    @observer.observe document, config


  onResize: (mutations) =>
    for mutation in mutations
      return @sync() if mutation.target.tagName == 'TEXTAREA'


  sync: =>
    heights = {}

    for reference in @references
      id = reference.getAttribute('data-sync-height-target')
      heights[id] = reference.offsetHeight

    for target in @targets
      height = heights[target.getAttribute('data-sync-height-id')]

      if height?
        target.style.minHeight = "#{height}px"
