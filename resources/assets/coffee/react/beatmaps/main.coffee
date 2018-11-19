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

{a, div, p} = ReactDOMFactories
el = React.createElement
VirtualList = window.VirtualList

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


class Beatmaps.Main extends React.PureComponent
  constructor: (props) ->
    super props

    prevState = JSON.parse(props.container.dataset.reactState ? '{}')

    @state = prevState.state unless _.isEmpty(prevState)
    @state ?= _.extend
      beatmaps: @props.beatmaps.beatmapsets
      paging:
        cursor: @props.beatmaps.cursor
        url: laroute.route('beatmapsets.search')
        loading: false
        more: @props.beatmaps.beatmapsets.length > 0
      loading: false
      filters: null
      isExpanded: null
      @stateFromUrl()

    @state.columnCount = @columnCount()

    @backToTop = React.createRef()
    @backToTopAnchor = React.createRef()


  columnCount: () ->
    if osu.isDesktop() then 2 else 1


  updateColumnCount: () =>
    @setState (prevState) =>
      count = @columnCount()
      # The list component has to be recreated for correct sizing.
      BeatmapList = VirtualList()(ListRender) if prevState.columnCount != count

      columnCount: count


  componentDidMount: =>
    $(document).on 'beatmap:load_more.beatmaps', @loadMore
    $(document).on 'beatmap:search:start.beatmaps', @search
    $(document).on 'beatmap:search:filtered.beatmaps', @updateFilters
    $(document).on 'turbolinks:before-cache.beatmaps', @saveState
    $(window).on 'resize.beatmaps', @updateColumnCount


  componentDidUpdate: (_prevProps, prevState) =>
    return if _.isEqual(prevState.filters, @state.filters)

    $(document).trigger 'beatmap:search:start'
    url = encodeURI laroute.route('beatmapsets.index', BeatmapsetFilter.queryParamsFromFilters(@state.filters))
    Turbolinks
      .controller
      .pushHistoryWithLocationAndRestorationIdentifier url, Turbolinks.uuid()


  componentWillUnmount: =>
    $(document).off '.beatmaps'
    $(window).off '.beatmaps'
    @xhr?.abort()


  render: =>
    searchBackground = @state.beatmaps[0]?.covers?.cover
    supporterFilters = @supporterFiltersTrans()
    listCssClasses = 'beatmapsets'
    listCssClasses += ' beatmapsets--dimmed' if @state.loading


    div
      className: 'osu-layout__section'
      el Beatmaps.SearchPanel,
        innerRef: @backToTopAnchor
        background: searchBackground
        availableFilters: @props.availableFilters
        filters: @state.filters
        filterDefaults: BeatmapsetFilter.getDefaults(@state.filters)
        expand: @expand
        isExpanded: @state.isExpanded

      div className: 'js-sticky-header'

      div
        className: 'osu-layout__row osu-layout__row--page-compact'
        div className: listCssClasses,
          if currentUser.id?
            el Beatmaps.SearchSort, sorting: @sorting(), filters: @state.filters

          div
            className: 'beatmapsets__content'
            if @isSupporterMissing()
              div className: 'beatmapsets__empty',
                el Img2x,
                  src: '/images/layout/beatmaps/supporter-required.png'
                  alt: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterFilters)
                  title: osu.trans('beatmaps.listing.search.supporter_filter', filters: supporterFilters)

                @renderLinkToSupporterTag(supporterFilters)

            else
              if @state.beatmaps.length > 0
                el BeatmapList,
                  items: _.chunk(@state.beatmaps, @state.columnCount)
                  itemBuffer: 5
                  itemHeight: ITEM_HEIGHT

              else
                div className: 'beatmapsets__empty',
                  el Img2x,
                    src: '/images/layout/beatmaps/not-found.png'
                    alt: osu.trans("beatmaps.listing.search.not-found")
                    title: osu.trans("beatmaps.listing.search.not-found")
                  osu.trans("beatmaps.listing.search.not-found-quote")

          el(Beatmaps.Paginator, @state.paging) unless @isSupporterMissing()

      el window._exported.BackToTop,
        anchor: @backToTopAnchor
        ref: @backToTop


  renderLinkToSupporterTag: (filters) ->
    url = laroute.route('store.products.show', product: 'supporter-tag')
    link = "<a href=\"#{url}\">#{osu.trans 'beatmaps.listing.search.supporter_filter_quote.link_text'}</a>"

    p
      dangerouslySetInnerHTML:
        __html: osu.trans 'beatmaps.listing.search.supporter_filter_quote._',
          filters: filters
          link: link


  expand: (e) =>
    e.preventDefault()

    @setState isExpanded: !@state.isExpanded


  fetchNewState: (newQuery = false) =>
    @fetchResults(newQuery)
    .then (data) =>
      beatmaps: if newQuery then data.beatmapsets else @state.beatmaps.concat(data.beatmapsets)
      loading: false
      paging:
        cursor: data.cursor
        url: @state.paging.url
        more: data.beatmapsets.length > 0


  fetchResults: (newQuery) =>
    params = BeatmapsetFilter.queryParamsFromFilters(@state.filters)
    params.cursor = @state.paging.cursor if !newQuery

    @xhr = $.ajax @state.paging.url,
      method: 'get'
      dataType: 'json'
      data: params

    osu.promisify @xhr


  isSupporterMissing: =>
    !currentUser.is_supporter && @supporterFilters().length > 0


  loadMore: =>
    if @state.loading || @state.paging.loading || !@state.paging.more
      return

    pagingState = _.extend {}, @state.paging
    pagingState.loading = true

    @setState paging: pagingState

    @fetchNewState().then (newState) =>
      @setState newState


  saveState: =>
    @props.container.dataset.reactState = JSON.stringify({@state})
    @componentWillUnmount()


  search: =>
    @xhr?.abort()

    return Promise.resolve() if @isSupporterMissing()

    @setState loading: true
    @backToTop.current.reset()

    @fetchNewState(true).then (newState) =>
      cutoff = @backToTopAnchor.current.getBoundingClientRect().top
      window.scrollTo window.pageXOffset, window.pageYOffset + cutoff if cutoff < 0

      @setState newState


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


  supporterFilters: =>
    _.reject ['played', 'rank'], (name) =>
      _.isEmpty @state.filters[name]


  supporterFiltersTrans: =>
    osu.transArray _.map @supporterFilters(), (name) ->
      osu.trans "beatmaps.listing.search.filters.#{name}"


  updateFilters: (_e, newFilters) =>
    newFilters = _.extend {}, @state.filters, newFilters

    if @state.filters.query != newFilters.query || @state.filters.status != newFilters.status
      newFilters.sort = null

    @setState filters: BeatmapsetFilter.fillDefaults(newFilters)
