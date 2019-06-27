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
import { BeatmapsetPanel } from 'beatmapset-panel'
import { Img2x } from 'img2x'
import { observe, observable } from 'mobx'
import { Observer } from 'mobx-react'
import core from 'osu-core-singleton'
import * as React from 'react'
import { a, div, p } from 'react-dom-factories'
import VirtualList from 'react-virtual-list'

el = React.createElement
beatmapsetStore = core.dataStore.beatmapsetStore
controller = core.beatmapsetSearchController

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
          key: (beatmapsetId for beatmapsetId in row).join('-')
          for beatmapsetId in row
            div
              className: 'beatmapsets__item'
              key: beatmapsetId
              el BeatmapsetPanel, beatmap: beatmapsetStore.get(beatmapsetId)

# stored in an observable so a rerender will occur when the HOC gets updated.
Observables = observable
  BeatmapList: VirtualList()(ListRender)
  numberOfColumns: if osu.isDesktop() then 2 else 1

observe Observables, 'numberOfColumns', (change) ->
  if change.oldValue != change.newValue
    Observables.BeatmapList = VirtualList()(ListRender)


export class SearchContent extends React.Component
  componentDidMount: ->
    $(window).on 'resize.beatmaps-search-content', ->
      count = if osu.isDesktop() then 2 else 1
      Observables.numberOfColumns = count if Observables.numberOfColumns != count


  componentWillUnmount: ->
    $(window).off '.beatmaps-search-content'


  render: ->
    el Observer, null, () =>
      beatmapsetIds = controller.currentBeatmapsetIds

      firstBeatmapset = beatmapsetStore.get(beatmapsetIds[0])
      searchBackground = if beatmapsetIds.length > 0 then firstBeatmapset?.covers?.cover else null
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
            if currentUser.id?
              div
                className: 'beatmapsets__sort'
                el SearchSort,
                  filters: controller.filters
                  sorting: sorting()

            div
              className: 'beatmapsets__content'
              if controller.isSupporterMissing
                div className: 'beatmapsets__empty',
                  el Img2x,
                    src: '/images/layout/beatmaps/supporter-required.png'
                    alt: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterRequiredFilterText)
                    title: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterRequiredFilterText)

                  renderLinkToSupporterTag(supporterRequiredFilterText)

              else
                if beatmapsetIds.length > 0
                  el Observables.BeatmapList,
                    items: _.chunk(beatmapsetIds, Observables.numberOfColumns)
                    itemBuffer: 5
                    itemHeight: ITEM_HEIGHT

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


sorting = ->
  [field, order] = controller.filters.displaySort.split('_')

  { field, order }


renderLinkToSupporterTag = (filterText) ->
  url = laroute.route('store.products.show', product: 'supporter-tag')
  link = "<a href=\"#{url}\">#{osu.trans 'beatmaps.listing.search.supporter_filter_quote.link_text'}</a>"

  p
    dangerouslySetInnerHTML:
      __html: osu.trans 'beatmaps.listing.search.supporter_filter_quote._',
        filters: filterText
        link: link
