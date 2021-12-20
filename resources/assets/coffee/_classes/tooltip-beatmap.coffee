# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

class window.TooltipBeatmap
  tmpl: _.template '<div class="tooltip-beatmap__text tooltip-beatmap__text--title"><%- beatmapTitle %></div>' +
      '<div class="tooltip-beatmap__text" style="--diff: var(--diff-<%- difficulty %>)"><%- stars %> <i class="fas fa-star" aria-hidden="true"></i></div>'

  constructor: ->
    $(document).on 'mouseover touchstart', '.js-beatmap-tooltip', @onMouseOver

  onMouseOver: (event) =>
    el = event.currentTarget

    return if !el.dataset.beatmapTitle?

    content = @tmpl el.dataset

    if el._tooltip
      $(el).qtip 'set', 'content.text': content
      return

    at = el.dataset.tooltipPosition ? 'top center'
    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'
      when 'right center' then 'left center'

    options =
      overwrite: false
      content: content
      position:
        my: my
        at: at
        viewport: $(window)
      show:
        event: event.type
        ready: true
      hide:
        event: 'click mouseleave'
      style:
        classes: 'qtip tooltip-beatmap'
        tip:
          width: 10
          height: 9

    if event.type == 'touchstart'
      options.hide =
        inactive: 3000
        event: 'unfocus'

    $(el).qtip options, event

    el._tooltip = true
