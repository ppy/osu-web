###
# Copyright 2016 ppy Pty. Ltd.
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
{div, span, a, i, nav, ul, li} = React.DOM

bn = 'ranking-scoreboard'

class RankingPage.ScoreboardPagination extends React.Component
  _pageTo: (i) =>
    $.publish 'ranking:scoreboard:set', page: i

  _pagePrev: (e) =>
    e.preventDefault()
    @_pageTo(@props.currentPage - 1)

  _pageNext: (e) =>
    e.preventDefault()
    @_pageTo(@props.currentPage + 1)

  contentPrev: ->
    span null,
      i className: 'fa fa-angle-left'
      osu.trans 'common.pagination.previous'

  contentNext: ->
    span null,
      osu.trans 'common.pagination.next'
      i className: 'fa fa-angle-right'

  render: ->
    nav
      className: "#{bn}__pagination",

      div null,
        'Page ' + (@props.currentPage + 1)

      ul
        className: "#{bn}__prevnext"

        li null,

          if @props.currentPage <= 0
            span null,
              @contentPrev()
          else
            a
              href: RankingPageHash.generate(page: @props.currentPage - 1, mode: @props.currentMode, country: @props.currentCountry),
              onClick: @_pagePrev,
              @contentPrev()

        li null,

          a
            href: RankingPageHash.generate(page: @props.currentPage + 1, mode: @props.currentMode, country: @props.currentCountry),
            onClick: @_pageNext,
            @contentNext()

            
