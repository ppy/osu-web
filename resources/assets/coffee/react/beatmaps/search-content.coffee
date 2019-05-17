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

import { Paginator } from './paginator'
import { SearchPanel } from './search-panel'
import { SearchSort } from './search-sort'
import { BeatmapSearchContext } from 'beatmap-search-context'
import { BeatmapsetPanel } from 'beatmapset-panel'
import { Img2x } from 'img2x'
import * as React from 'react'
import { a, div, p } from 'react-dom-factories'
import VirtualList from 'react-virtual-list'
el = React.createElement

ITEM_HEIGHT = 205 # needs to be known in advance to calculate size of virtual scrolling area.

ListRender = ({ virtual, itemHeight }) ->
  style = _.extend {}, virtual.style
  div
    style: style
    div
      className: 'beatmapsets__items'
      virtual.items.map (row) ->
        div
          className: 'beatmapsets__items-row'
          key: (beatmap.id for beatmap in row).join('-')
          for beatmap in row
            div
              className: 'beatmapsets__item'
              key: beatmap.id
              el BeatmapsetPanel, beatmap: beatmap

BeatmapList = VirtualList()(ListRender)


export SearchContent = (props) ->
  [columnCount, setColumnCount] = React.useState(if osu.isDesktop() then 2 else 1)
  React.useEffect () ->
    # FIXME: fires more times than necessary?
    $(window).on 'resize.beatmaps-search-content', () ->
      count = if osu.isDesktop() then 2 else 1
      # The list component has to be recreated for correct sizing.
      BeatmapList = VirtualList()(ListRender) if columnCount != count
      setColumnCount count

    () ->
      $(window).off '.beatmaps-search-content'

  filters = React.useContext(BeatmapSearchContext)

  searchBackground = props.beatmaps?[0]?.covers?.cover
  supporterFilters = supporterFiltersTrans(filters)
  supporterMissing = isSupporterMissing(filters)
  listCssClasses = 'beatmapsets'
  listCssClasses += ' beatmapsets--dimmed' if props.loading

  el React.Fragment, null,
    el SearchPanel,
      innerRef: props.backToTopAnchor
      background: searchBackground
      availableFilters: props.availableFilters
      expand: props.expand
      isExpanded: props.isExpanded
      recommendedDifficulty: props.recommendedDifficulty

    div className: 'js-sticky-header'

    div
      className: 'osu-layout__row osu-layout__row--page-compact'
      div className: listCssClasses,
        if currentUser.id?
          div
            className: 'beatmapsets__sort'
            el SearchSort,
              sorting: sorting(filters)

        div
          className: 'beatmapsets__content'
          if supporterMissing
            div className: 'beatmapsets__empty',
              el Img2x,
                src: '/images/layout/beatmaps/supporter-required.png'
                alt: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterFilters)
                title: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterFilters)

              renderLinkToSupporterTag(supporterFilters)

          else
            if props.beatmaps.length > 0
              el BeatmapList,
                items: _.chunk(props.beatmaps, columnCount)
                itemBuffer: 5
                itemHeight: ITEM_HEIGHT

            else
              div className: 'beatmapsets__empty',
                el Img2x,
                  src: '/images/layout/beatmaps/not-found.png'
                  alt: osu.trans("beatmaps.listing.search.not-found")
                  title: osu.trans("beatmaps.listing.search.not-found")
                osu.trans("beatmaps.listing.search.not-found-quote")

        if !supporterMissing
          div className: 'beatmapsets__paginator',
            el Paginator,
              error: props.error
              loading: props.isPaging
              more: props.hasMore


sorting = (filters) ->
  [field, order] = filters.sort.split('_')

  { field, order }


isSupporterMissing = (filters) ->
  !currentUser.is_supporter && BeatmapsetFilter.supporterRequired(filters).length > 0


renderLinkToSupporterTag = (filters) ->
  url = laroute.route('store.products.show', product: 'supporter-tag')
  link = "<a href=\"#{url}\">#{osu.trans 'beatmaps.listing.search.supporter_filter_quote.link_text'}</a>"

  p
    dangerouslySetInnerHTML:
      __html: osu.trans 'beatmaps.listing.search.supporter_filter_quote._',
        filters: filters
        link: link


supporterFiltersTrans = (filters) ->
  osu.transArray _.map BeatmapsetFilter.supporterRequired(filters), (name) ->
    osu.trans "beatmaps.listing.search.filters.#{name}"
