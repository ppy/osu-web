# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class @SyncHeight
  constructor: ->
    @targets = document.getElementsByClassName('js-sync-height--target')
    @references = document.getElementsByClassName('js-sync-height--reference')
    @throttledSync = _.throttle @sync, 100

    $(document).on 'turbolinks:load', @sync
    $.subscribe 'osu:page:change', @throttledSync
    $.subscribe 'sync-height:force', @sync
    $(window).on 'resize', @sync

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
