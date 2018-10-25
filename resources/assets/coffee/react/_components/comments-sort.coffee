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

{button, div} = ReactDOMFactories

class @CommentsSort extends React.PureComponent
  render: =>
    div className: osu.classWithModifiers('comments-sort', @props.modifiers),
      div className: 'comments-sort__item',
        osu.trans('comments.sort._')
      @renderButton('new')
      @renderButton('old')
      @renderButton('top')


  renderButton: (sort) =>
    className = 'comments-sort__item comments-sort__item--button'
    className += ' comments-sort__item--active' if sort == (@props.loadingSort ? @props.currentSort)

    button
      className: className
      'data-sort': sort
      onClick: @setSort
      osu.trans("comments.sort.#{sort}")


  setSort: (e) =>
    $.publish 'comments:sort', sort: e.target.dataset.sort
