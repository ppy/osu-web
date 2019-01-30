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

{button, div} = ReactDOMFactories

class @CommentsSort extends React.PureComponent
  render: =>
    div className: osu.classWithModifiers('sort', @props.modifiers),
      div className: 'sort__items',
        div className: 'sort__item sort__item--title', osu.trans('sort._')
        @renderButton('new')
        @renderButton('old')
        @renderButton('top')


  renderButton: (sort) =>
    className = 'sort__item sort__item--button'
    className += ' sort__item--active' if sort == (@props.loadingSort ? @props.currentSort)

    button
      className: className
      'data-sort': sort
      onClick: @setSort
      osu.trans("sort.#{sort}")


  setSort: (e) =>
    $.publish 'comments:sort', sort: e.target.dataset.sort
