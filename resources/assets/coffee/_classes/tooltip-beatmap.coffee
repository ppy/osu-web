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

class @TooltipBeatmap
  constructor: ->
    $(document).on 'mouseover', '[data-beatmap-title]', @onMouseOver

  onMouseOver: (event) ->
    el = event.currentTarget

    return if !el.dataset.beatmapTitle?

    tmpl = _.template '<span class="tooltip-beatmap__title"><%= beatmapTitle %></span>' +
      '<span class="tooltip-beatmap__stars tooltip-beatmap__stars--<%= difficulty %>"><%= stars %> <i class="fa fa-star" aria-hidden="true"></i></span>'

    at = el.dataset.tooltipPosition ? 'top center'
    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'
      when 'right center' then 'left center'

    content = tmpl el.dataset

    if el._tooltip
      $(el).qtip 'set', 'content.text': content
      return

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
        inactive: 3000
      style:
        classes: 'qtip tooltip-beatmap'
        tip:
          width: 10
          height: 9

    $(el).qtip options, event

    el._tooltip = true
