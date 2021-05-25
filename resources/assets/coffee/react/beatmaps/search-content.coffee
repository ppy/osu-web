# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import { Paginator } from './paginator'
import { SearchPanel } from './search-panel'
import { SearchSort } from './search-sort'
import BeatmapsetCardSizeSelector from 'beatmaps/beatmapset-card-size-selector'
import VirtualListMeta from 'beatmaps/virtual-list-meta'
import BeatmapsetPanel, { beatmapsetCardSizes } from 'beatmapset-panel'
import { Img2x } from 'img2x'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, div, p } from 'react-dom-factories'
import VirtualList from 'react-virtual-list'
import { showVisual } from 'utils/beatmapset-helper'

el = React.createElement

ListRender = ({ virtual, itemHeight }) ->
  div
    style: virtual.style
    div
      className: 'beatmapsets__items'
      virtual.items.map (row) ->
        div
          className: 'beatmapsets__items-row'
          key: (beatmapsetId for beatmapsetId in row).join('-')
          for beatmapsetId in row
            div
              className: 'beatmapsets__item'
              key: beatmapsetId
              el BeatmapsetPanel, beatmapset: core.dataStore.beatmapsetStore.get(beatmapsetId)

BeatmapList = VirtualList()(ListRender)


export class SearchContent extends React.Component
  constructor: ->
    @virtualListMeta = new VirtualListMeta


  render: ->
    el Observer, null, () =>
      controller = core.beatmapsetSearchController
      beatmapsetIds = controller.currentBeatmapsetIds

      firstBeatmapset = core.dataStore.beatmapsetStore.get(beatmapsetIds[0])
      searchBackground = if firstBeatmapset? && showVisual(firstBeatmapset) then firstBeatmapset.covers?.cover else null
      supporterRequiredFilterText = controller.supporterRequiredFilterText
      listCssClasses = 'beatmapsets'
      listCssClasses += ' beatmapsets--dimmed' if controller.isBusy

      el React.Fragment, null,
        el SearchPanel,
          innerRef: @props.backToTopAnchor
          background: searchBackground
          availableFilters: @props.availableFilters

        div className: 'js-sticky-header'

        div
          className: 'osu-layout__row osu-layout__row--page-compact'
          div className: listCssClasses,
            if controller.advancedSearch
              div className: 'beatmapsets__toolbar',
                div className: 'beatmapsets__toolbar-item',
                  el SearchSort, filters: controller.filters
                div className: 'beatmapsets__toolbar-item',
                  div className: 'sort hidden-xs', div className: 'sort__items',
                    beatmapsetCardSizes.map (size) =>
                      el BeatmapsetCardSizeSelector,
                        key: size
                        classElement: 'sort__item'
                        size: size

            div
              className: 'beatmapsets__content js-audio--group'
              if controller.isSupporterMissing
                div className: 'beatmapsets__empty',
                  el Img2x,
                    src: '/images/layout/beatmaps/supporter-required.png'
                    alt: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterRequiredFilterText)
                    title: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterRequiredFilterText)

                  renderLinkToSupporterTag(supporterRequiredFilterText)

              else
                if beatmapsetIds.length > 0
                  el BeatmapList,
                    items: _.chunk(beatmapsetIds, @virtualListMeta.numberOfColumns)
                    itemBuffer: 5
                    itemHeight: @virtualListMeta.itemHeight

                else
                  div className: 'beatmapsets__empty',
                    el Img2x,
                      src: '/images/layout/beatmaps/not-found.png'
                      alt: osu.trans("beatmaps.listing.search.not-found")
                      title: osu.trans("beatmaps.listing.search.not-found")
                    osu.trans("beatmaps.listing.search.not-found-quote")

            if !controller.isSupporterMissing
              div className: 'beatmapsets__paginator',
                el Paginator,
                  error: controller.error
                  loading: controller.isPaging
                  more: controller.hasMore


renderLinkToSupporterTag = (filterText) ->
  url = laroute.route('store.products.show', product: 'supporter-tag')
  link = "<a href=\"#{url}\">#{osu.trans 'beatmaps.listing.search.supporter_filter_quote.link_text'}</a>"

  p
    dangerouslySetInnerHTML:
      __html: osu.trans 'beatmaps.listing.search.supporter_filter_quote._',
        filters: filterText
        link: link
