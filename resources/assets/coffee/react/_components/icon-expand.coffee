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

{span} = ReactDOMFactories
el = React.createElement

elem = ({position, icon}) ->
  span
    key: position
    className: "icon-stack__icon icon-stack__icon--#{position}"
    el Icon, name: icon, modifiers: ['fw']

@IconExpand = ({expand = true, parentClass = ''}) ->
  span
    className: "icon-stack #{parentClass}"
    span className: 'icon-stack__base',
      el Icon, name: 'angle-down', modifiers: ['fw']
    if expand
      [
        elem position: 'top', icon: 'angle-up'
        elem position: 'bottom', icon: 'angle-down'
      ]
    else
      [
        elem position: 'top', icon: 'angle-down'
        elem position: 'bottom', icon: 'angle-up'
      ]
