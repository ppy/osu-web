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

{div, span, a} = React.DOM

class Ranking.Paginator extends React.Component
  pageLink: (page, label, active = false) =>
    classes = [
      'ranking-page-paginator__page',
      'ranking-page-paginator__page--current' if active
    ]

    if page == @props.page
      classes.push 'ranking-page-paginator__page--disabled' if !active
      span
        key: "page-#{label}"
        className: classes.join ' '
        label
    else
      a
        key: "page-#{label}"
        href: '#',
        onClick: @changePage,
        'data-page': page,
        className: classes.join ' '
        label


  changePage: (e) =>
    e.preventDefault()
    page = parseInt(e.target.dataset.page)
    if (@props.page != page)
      @props.onPageChange page


  render: =>
    page = @props.page
    maxPages = @props.pages
    range = Math.min(maxPages-1, 8) # number of pages (excluding current page) to show at a time

    pagesOnLeft = Math.floor(range/2)

    # current page will be left of the center
    if page < pagesOnLeft
      leftStart = 1
    # current page will be right of the center
    else if page > (maxPages - pagesOnLeft)
      leftStart = maxPages - range
    # current page will be centered
    else
      leftStart = page - pagesOnLeft

    leftStart = Math.max(1, leftStart)
    rightEnd = leftStart + range

    div className: 'ranking-page-paginator',
      # first/previous page links
      @pageLink 1, '«'
      @pageLink Math.max(1, @props.page - 1), '‹'

      # page links
      for page in [leftStart..rightEnd]
        @pageLink page, page, page == @props.page

      # next/last page links
      @pageLink Math.min(@props.pages, @props.page + 1), '›'
      @pageLink @props.pages, '»'
