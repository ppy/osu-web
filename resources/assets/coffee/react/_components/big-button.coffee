###
# Copyright 2015-2016 ppy Pty. Ltd.
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
{a, button, div, span} = React.DOM
el = React.createElement

@BigButton = ({modifiers = [], text, icon, props = {}}) ->
  props.className = 'btn-osu-big'
  props.className += " btn-osu-big--#{mod}" for mod in modifiers

  blockElement = if props.href? then a else button

  blockElement props,
    div className: 'btn-osu-big__content',
      div className: 'btn-osu-big__left',
        span className: 'btn-osu-big__text-top', text.top ? text
        if text.bottom?
          span className: 'btn-osu-big__text-bottom', text.bottom
      if icon?
        div className: 'btn-osu-big__icon',
          el Icon, name: icon
