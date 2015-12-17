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
    return if event.target._tooltip

    event.target._tooltip = true

    title = event.target.getAttribute 'title'

    at = event.target.getAttribute('data-tooltip-position') || 'top center'

    my = switch at
      when 'top center' then 'bottom center'
      when 'left center' then 'right center'

    options =
      overwrite: false
      content: title
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
        classes: 'qtip tooltip-default'
        tip:
          width: 10
          height: 8

    event.target.setAttribute 'data-orig-title', title
    event.target.removeAttribute 'title'

    $(event.target).qtip options, event
