###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License version 3
*    as published by the Free Software Foundation.
*
*    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
*    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*    See the GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
*
###

{div} = React.DOM
el = React.createElement

class Beatmaps.Main extends React.Component
  constructor: (props) ->
    super props
    beatmaps = JSON.parse(document.getElementById('json-beatmaps').text)['data']
    @state =
      beatmaps: beatmaps
      query: null
      paging:
        page: 1
        url: '/beatmaps/search'
        loading: false
        more: beatmaps.length > 0
      filters: @filterDefaults
      sorting:
        field: 'ranked'
        order: 'desc'
      loading: false
      just_restored: true

  filterDefaults:
    mode: '0'
    status: '0'
    genre: null
    language: null
    extra: null
    rank: null

  getFilterState: =>
    'm': @state.filters.mode
    's': @state.filters.status
    'g': @state.filters.genre
    'l': @state.filters.language
    'e': @state.filters.extra
    'r': @state.filters.rank

  getSortState: =>
    'sort': [@state.sorting.field, @state.sorting.order].join('_')

  validSortFields: ->
    ['title', 'artist', 'creator', 'difficulty', 'ranked', 'rating', 'plays']

  validSortOrders: ->
    ['asc', 'desc']

  charToKey: (char) ->
    switch char
      when 'm' then 'mode'
      when 's' then 'status'
      when 'g' then 'genre'
      when 'l' then 'language'
      when 'e' then 'extra'
      when 'r' then 'rank'
      when 'q' then 'query'

  buildSearchQuery: (query) =>
    $.extend {'q': query}, @getFilterState(), @getSortState()

  search: =>
    searchText = $('#searchbox').val()?.trim()

    # update url
    filterState = @getFilterState()
    sortState = @getSortState()

    $.each filterState, (k,v) =>
      if !v || @filterDefaults[@charToKey(k)] == v
        delete filterState[k]

    params = []
    if searchText
      params.push("q=#{encodeURIComponent(searchText)}")
    for key, value of filterState
      params.push("#{key}=#{value}")
    for key, value of sortState
      if value != 'ranked_desc'
        params.push("so=#{value}")

    if @state.just_restored or location.search.substr(1) != params.join('&')
      if !@state.just_restored
        history.pushState(@state, "¯\_(ツ)_/¯", "/beatmaps/?#{params.join('&')}")

      @showLoader()
      $.ajax @state.paging.url,
        method: 'get'
        dataType: 'json'
        data: @buildSearchQuery(searchText)
      .done (data) =>
        newState =
          beatmaps: data['data']
          query: searchText
          paging:
            page: 1
            url: @state.paging.url
            loading: false
            more: data['data'].length > 10
          just_restored: false
          loading: false

        @setState newState, ->
            $(document).trigger 'beatmap:search:done'

  loadMore: =>
    if @state.loading or @state.paging.loading or !@state.paging.more
      return

    paging_state = @state.paging
    paging_state.loading = true

    @setState paging: paging_state

    searchText = $('#searchbox').val()?.trim()

    $.ajax @state.paging.url,
      method: 'get'
      dataType: 'json'
      data: $.extend(@buildSearchQuery(searchText), 'page': @state.paging.page + 1)
    .done (data) =>
      more = data['data'].length > 10
      newState =
        beatmaps: @state.beatmaps.concat(data['data'])
        paging:
          page: @state.paging.page + (if more then 1 else 0)
          url: @state.paging.url
          more: more
        loading: false

      @setState newState

  showLoader: =>
    @setState loading: true
    $('#loading-area').show()

  hideLoader: =>
    @setState loading: false
    $('#loading-area').hide()

  updateFilters: (_e, payload) =>
    newFilters = $.extend({}, @state.filters) # clone object
    newFilters[payload.name] = payload.value

    if @state.filters != newFilters
      @setState filters: newFilters, ->
        $(document).trigger 'beatmap:search:start'

  updateSort: (_b, payload) =>
    if @state.sorting != payload
      @setState sorting: payload, ->
        $(document).trigger 'beatmap:search:start'

  convertFilterKeys: (obj) ->
    newObj = {}
    for key of obj
      newObj[@charToKey(key)] = obj[key]
    return newObj

  restoreState: ->
    state = {}
    params = location.search.substr(1).split('&')
    filters = []
    sorting = {'field': 'ranked', 'order': 'desc'}

    for filter of @getFilterState()
      filters.push(filter)

    expand = false
    present = false
    query = null

    for part in params
      [key, value] = part.split('=')
      if $.inArray(key, ['g', 'l', 'e', 'r']) > -1
        expand = true

      if $.inArray(key, filters) > -1
        state[key] = value
        present = true

      if key == 'so'
        [sort_field, sort_order] = value.split('_')
        if $.inArray(sort_field, @validSortFields()) > -1 && $.inArray(sort_order, @validSortOrders()) > -1
          sorting = {'field': sort_field, 'order': sort_order}
          present = true

      if key == 'q'
        value = decodeURIComponent(value)
        $('#searchbox').val(value)
        query = value
        present = true

    if present
      newState = $.extend(this.getFilterState(), state) # clone
      newState = @convertFilterKeys(newState)           # convert keys

      @setState filters: newState, sorting: sorting, just_restored: true, ->
        @search()
        if expand
          $('#search').addClass 'expanded' #such seperation of concerns

  componentDidMount: ->
    @componentWillUnmount()
    $(document).on 'beatmap:load_more.beatmaps', @loadMore
    $(document).on 'beatmap:search:start.beatmaps', @search
    $(document).on 'beatmap:search:done.beatmaps', @hideLoader
    $(document).on 'beatmap:search:filtered.beatmaps', @updateFilters
    $(document).on 'beatmap:search:sorted.beatmaps', @updateSort
    $(document).on 'ready.beatmaps page:load.beatmaps osu:page:change.beatmaps', (e) =>
      @restoreState()
    $(window).on 'popstate.beatmaps', (e) =>
      @restoreState()

  componentWillUnmount: ->
    $(document).off '.beatmaps'
    $(window).off '.beatmaps'

  render: ->
    if @state.beatmaps.length > 0
      searchBackground = @state.beatmaps[0].covers.cover
    else
      searchBackground = ''

    div className: 'osu-layout__section',
      el(Beatmaps.SearchPanel, background: searchBackground, filters: @state.filters)
      div id: 'beatmaps-listing', className: 'osu-layout__row osu-layout__row--page',
        if (currentUser.id != undefined)
          el(Beatmaps.SearchSort, sorting: @state.sorting)
        el(Beatmaps.BeatmapsListing, beatmaps: @state.beatmaps, loading: @state.loading)
        el(Beatmaps.Paginator, paging: @state.paging)
