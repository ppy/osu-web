###
#    Copyright 2015-2018 ppy Pty. Ltd.
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
import { a } from 'react-dom-factories'
import { SelectOptions } from 'select-options'

bn = 'spotlight-select-options'

export class SpotlightSelectOptions extends PureComponent
  render: =>
    el SelectOptions,
      bn: bn
      renderItem: @renderItem
      onItemSelected: @onItemSelected
      options: @props.options
      selected: @props.selected


  renderItem: ({ children, key, onClick, selected }) =>
    classNames = "#{bn}__item"
    classNames += " #{bn}__item--selected" if selected

    a
      children: children
      className: classNames
      href: @href(key)
      key: key
      onClick: onClick


  href: (key) ->
    url = new URL(window.location)
    url.searchParams.set 'spotlight', key if key?

    url


  onItemSelected: (item) =>
    Turbolinks.visit @href(item.id)
