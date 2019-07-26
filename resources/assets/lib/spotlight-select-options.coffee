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

import { createElement as el, PureComponent } from 'react'
import * as React from 'react'
import { a } from 'react-dom-factories'
import { SelectOptions } from 'select-options'

export class SpotlightSelectOptions extends PureComponent
  render: =>
    el SelectOptions,
      bn: 'spotlight-select-options'
      renderItem: @renderItem
      onItemSelected: @onItemSelected
      options: @props.options
      selected: @props.selected


  renderItem: ({ cssClasses, children, item, onClick }) =>
    a
      children: children
      className: cssClasses
      href: @href(item?.id)
      key: item?.id
      onClick: onClick


  href: (key) ->
    window.osu.updateQueryString(null, spotlight: key)


  onItemSelected: (item) =>
    Turbolinks.visit @href(item.id)
