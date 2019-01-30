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

el = React.createElement
{span, i} = ReactDOMFactories

bn = 'supporter-icon'

# see also _supporter_icon.blade.php for blade version
@SupporterIcon = ({background = false, smaller = false}) ->
  blockClass = bn

  span
    className: "#{bn}#{if smaller then " #{bn}--smaller" else ''} fa-stack"
    title: osu.trans('users.show.is_supporter')

    if background
      i className: "#{bn}__bg fas fa-circle fa-stack-2x"

    i className: "far fa-circle fa-stack-2x"
    i className: "#{bn}__heart fas fa-heart fa-stack-1x"
