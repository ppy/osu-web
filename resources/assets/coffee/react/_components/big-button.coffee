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

{a, button, span} = ReactDOMFactories
el = React.createElement

@BigButton = ({modifiers = [], text, icon, props = {}, extraClasses = []}) ->
  props.className = 'btn-osu-big'
  props.className += " btn-osu-big--#{mod}" for mod in modifiers
  props.className += " #{klass}" for klass in extraClasses

  blockElement = if props.href? then a else button

  blockElement props,
    span className: "btn-osu-big__content #{if !text? || !icon? then 'btn-osu-big__content--center' else ''}",
      if text?
        span className: 'btn-osu-big__left',
          span className: 'btn-osu-big__text-top', text.top ? text
          if text.bottom?
            span className: 'btn-osu-big__text-bottom', text.bottom
      if icon?
        span className: 'btn-osu-big__icon',
          el Icon, name: icon
