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

import { SearchContent } from './search-content'
import { BeatmapSearchContext } from 'beatmap-search-context'
import * as BeatmapSearchService from 'beatmap-search-service'
import { BackToTop } from 'back-to-top'
import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement


export class Main extends React.PureComponent
  constructor: (props) ->
    super props

    urlState = @stateFromUrl()

    # populate initial values
    BeatmapSearchService.initialize urlState.filters, props.beatmaps

    @debouncedSearch = _.debounce @search, 500

    prevState = JSON.parse(props.container.dataset.reactState ? '{}')
    @state =
      beatmaps: []
      hasMore: true
      isPaging: false
      loading: false
      recommendedDifficulty: @props.beatmaps.recommended_difficulty

    @state = _.extend @state, prevState unless _.isEmpty(prevState)
    @state = _.extend @state, @stateFromUrl()

    @backToTop = React.createRef()
    @backToTopAnchor = React.createRef()


  componentDidMount: =>
    $(document).on 'beatmap:load_more.beatmaps', @loadMore
    $(document).on 'beatmap:search:filtered.beatmaps', @updateFilters
    $(document).on 'turbolinks:before-cache.beatmaps', @saveState

    @fetchNewState()
    .then (newState) =>
      @setState newState


  componentDidUpdate: (_prevProps, prevState) =>
    return if _.isEqual(prevState.filters, @state.filters)

    @debouncedSearch()


  componentWillUnmount: =>
    $(document).off '.beatmaps'
    $(window).off '.beatmaps'
    @debouncedSearch.cancel


  render: =>
    contentState = _.extend {}, @state,
      backToTopAnchor: @backToTopAnchor
      availableFilters: @props.availableFilters
      expand: @expand

    div
      className: 'osu-layout__section'
      el BeatmapSearchContext.Provider,
        value: @state.filters
        el SearchContent, contentState

      el BackToTop,
        anchor: @backToTopAnchor
        ref: @backToTop


  expand: (e) =>
    e.preventDefault()

    @setState isExpanded: !@state.isExpanded


  fetchNewState: (from = 0) =>
    BeatmapSearchService.get(@state.filters, from)
    .then (data) ->
      beatmaps: data.beatmapsets
      error: null
      hasMore: data.hasMore && data.beatmapsets.length < data.total
      isPaging: false
      loading: false
      recommendedDifficulty: data.recommended_difficulty
    .catch (error) ->
      throw error unless error.readyState == 0


  isSupporterMissing: =>
    !currentUser.is_supporter && BeatmapsetFilter.supporterRequired(@state.filters).length > 0


  loadMore: =>
    if @state.isPaging || @state.loading || !@state.hasMore
      return

    @search @state.beatmaps.length


  saveState: =>
    { isExpanded } = @state
    @props.container.dataset.reactState = JSON.stringify { isExpanded }


  search: (from = 0) =>
    url = encodeURI laroute.route('beatmapsets.index', BeatmapsetFilter.queryParamsFromFilters(@state.filters))
    if from == 0
      Turbolinks.controller.pushHistoryWithLocationAndRestorationIdentifier url, Turbolinks.uuid()

    return Promise.resolve() if @isSupporterMissing() || from < 0

    if from > 0
      @setState
        isPaging: true
    else
      @backToTop.current.reset()
      @setState
        loading: true

    @fetchNewState(from)
    .then (newState) =>
      return unless newState?
      if from == 0
        cutoff = @backToTopAnchor.current.getBoundingClientRect().top
        window.scrollTo window.pageXOffset, window.pageYOffset + cutoff if cutoff < 0

      @setState newState

    .catch (error) =>
      osu.ajaxError error
      @setState
        error: error
        isPaging: false
        loading: false


  stateFromUrl: ->
    filters = BeatmapsetFilter.filtersFromUrl(location.href)

    filters: BeatmapsetFilter.fillDefaults(filters)
    isExpanded: _.intersection(Object.keys(filters), BeatmapsetFilter.expand).length > 0


  updateFilters: (_e, newFilters) =>
    newFilters = _.extend {}, @state.filters, newFilters

    if @state.filters.query != newFilters.query || @state.filters.status != newFilters.status
      newFilters.sort = null

    @setState filters: BeatmapsetFilter.fillDefaults(newFilters)
