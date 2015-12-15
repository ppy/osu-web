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
class @Tooltip
  constructor: ->
    $(document).on 'mouseover', '[title]', @onMouseOver

  onMouseOver: (event) =>
    return if event.target._tooltip

    event.target._tooltip = true

    title = event.target.getAttribute 'title'

    options =
      overwrite: false
      content: title
      position:
        my: 'bottom center'
        at: 'top center'
        viewport: $(window)
      show:
        event: event.type
        ready: true
      hide:
        inactive: 3000
      style:
        classes: 'qtip tooltip-default'

    event.target.setAttribute 'data-orig-title', title
    event.target.removeAttribute 'title'

    $(event.target).qtip options, event
