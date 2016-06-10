###
# Copyright 2015 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
class @TooltipDefault
  constructor: ->
    $(document).on 'mouseover', '[title]', @onMouseOver

  onMouseOver: (event) =>
    el = event.currentTarget

    title = el.getAttribute 'title'
    el.removeAttribute 'title'

    return if _.size(title) == 0

    $content = $('<span>').text(title)

    if el._tooltip
      $(el).qtip 'set', 'content.text': $content
      return

    el._tooltip = true

    at = el.getAttribute('data-tooltip-position') ? 'top center'

    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'
      when 'right center' then 'left center'

    classes = 'qtip tooltip-default'
    if el.getAttribute('data-tooltip-float') == 'fixed'
      classes += ' tooltip-default--fixed'

    options =
      overwrite: false
      content: $content
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
        classes: classes
        tip:
          width: 10
          height: 8

    el.setAttribute 'data-orig-title', title

    $(el).qtip options, event
