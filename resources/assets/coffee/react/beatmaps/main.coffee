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

{div} = ReactDOMFactories
el = React.createElement

class Beatmaps.Main extends React.PureComponent
  constructor: (props) ->
    super props

    @url = location.href
    @xhr = {}

    prevState = JSON.parse(props.container.dataset.reactState ? '{}')

    @state = prevState.state if prevState.url == location.href
    @state ?= _.extend
      beatmaps: @props.beatmaps
      paging:
        page: 1
        url: laroute.route('beatmapsets.search')
        loading: false
        more: @props.beatmaps.length > 0
      loading: false
      filters: null
      isExpanded: null
      @stateFromUrl()


  componentDidMount: =>
    $(document).on 'beatmap:load_more.beatmaps', @loadMore
    $(document).on 'beatmap:search:start.beatmaps', @search
    $(document).on 'beatmap:search:done.beatmaps', @hideLoader
    $(document).on 'beatmap:search:filtered.beatmaps', @updateFilters
    $(document).on 'turbolinks:before-visit.beatmaps', @recordUrl
    $(document).on 'turbolinks:before-cache.beatmaps', @saveState


  componentWillUnmount: =>
    $(document).off '.beatmaps'
    $(window).off '.beatmaps'
    xhr.abort() for own _type, xhr of @xhr when xhr?


  render: =>
    searchBackground = @state.beatmaps[0]?.covers?.cover

    div className: 'osu-layout__section',
      el Beatmaps.SearchPanel,
        background: searchBackground
        availableFilters: @props.availableFilters
        filters: @state.filters
        filterDefaults: BeatmapsetFilter.getDefaults(@state.filters)
        expand: @expand
        isExpanded: @state.isExpanded

      div className: 'osu-layout__row osu-layout__row--page-compact',
        div className: "beatmapsets #{'beatmapsets--dimmed' if @state.loading}",
          if currentUser.id?
            el Beatmaps.SearchSort, sorting: @sorting(), filters: @state.filters

          div
            className: 'beatmapsets__content'
            if @state.beatmaps.length > 0
              div
                className: 'beatmapsets__items'
                for beatmap in @state.beatmaps
                  div
                    className: 'beatmapsets__item'
                    key: beatmap.id
                    el BeatmapsetPanel, beatmap: beatmap

            else
              div className: 'beatmapsets__empty',
                el Img2x,
                  src: '/images/layout/beatmaps/not-found.png'
                  alt: osu.trans("beatmaps.listing.search.not-found")
                  title: osu.trans("beatmaps.listing.search.not-found")
                osu.trans("beatmaps.listing.search.not-found-quote")

          el(Beatmaps.Paginator, paging: @state.paging)


  buildSearchQuery: =>
    return {} if !currentUser.id?

    params = _.extend {}, @state.filters

    keyToChar = _.invert BeatmapsetFilter.charToKey
    charParams = {}

    for own key, value of params
      if value? && BeatmapsetFilter.getDefault(params, key) != value
        charParams[keyToChar[key]] = value

    delete charParams[keyToChar['rank']] if !currentUser.isSupporter

    charParams


  expand: (e) =>
    e.preventDefault()

    @setState isExpanded: !@state.isExpanded


  hideLoader: =>
    @setState loading: false


  loadMore: =>
    if @state.loading || @state.paging.loading || !@state.paging.more
      return

    pagingState = _.extend {}, @state.paging
    pagingState.loading = true

    @setState paging: pagingState

    @xhr.pagination = $.ajax @state.paging.url,
      method: 'get'
      dataType: 'json'
      data: _.extend @buildSearchQuery(), page: @state.paging.page + 1
    .done (data) =>
      more = data.length > 0

      @setState
        beatmaps: [].concat(@state.beatmaps, data)
        paging:
          page: @state.paging.page + (if more then 1 else 0)
          url: @state.paging.url
          more: more
        loading: false


  recordUrl: =>
    @url = location.href


  saveState: =>
    @props.container.dataset.reactState = JSON.stringify({@state, @url})
    @componentWillUnmount()


  search: =>
    @xhr.search?.abort()

    params = @buildSearchQuery()
    newUrl = laroute.route 'beatmapsets.index', params

    return if "#{location.pathname}#{location.search}" == newUrl

    @showLoader()
    @xhr.search = $.ajax @state.paging.url,
      method: 'get'
      dataType: 'json'
      data: params
    .done (data) =>
      newState =
        beatmaps: data
        paging:
          page: 1
          url: @state.paging.url
          loading: false
          more: data.length > 0
        loading: false

      @setState newState, ->
          $(document).trigger 'beatmap:search:done'


  showLoader: =>
    @setState loading: true


  sorting: =>
    [field, order] = @state.filters.sort.split('_')

    { field, order }


  stateFromUrl: =>
    params = location.search.substr(1).split('&')

    expand = false

    filters = {}

    for part in params
      [key, value] = part.split('=')
      value = decodeURIComponent(value)
      key = BeatmapsetFilter.charToKey[key]

      continue if !key? || value.length == 0

      value = BeatmapsetFilter.castFromString[key](value) if BeatmapsetFilter.castFromString[key]
      expand = true if key in BeatmapsetFilter.expand

      filters[key] = value

    filters: BeatmapsetFilter.fillDefaults(filters)
    isExpanded: expand


  updateFilters: (_e, newFilters) =>
    newFilters = _.extend {}, @state.filters, newFilters

    if @state.filters.query != newFilters.query || @state.filters.status != newFilters.status
      newFilters.sort = null

    newFilters = BeatmapsetFilter.fillDefaults(newFilters)

    if !_.isEqual @state.filters, newFilters
      @setState filters: newFilters, ->
        $(document).trigger 'beatmap:search:start'
        # copied from https://github.com/turbolinks/turbolinks/pull/61
        url = encodeURI laroute.route('beatmapsets.index', @buildSearchQuery())
        Turbolinks
          .controller
          .pushHistoryWithLocationAndRestorationIdentifier url, Turbolinks.uuid()
