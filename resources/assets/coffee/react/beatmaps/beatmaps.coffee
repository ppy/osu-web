###*
*    Copyright 2015 ppy Pty. Ltd.
*
*    This file is part of osu!web. osu!web is distributed with the hope of
*    attracting more community contributions to the core ecosystem of osu!.
*
*    osu!web is free software: you can redistribute it and/or modify
*    it under the terms of the Affero GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
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

window.Beatmaps = React.createClass(
  getInitialState: ->
    {
      beatmaps: JSON.parse(document.getElementById('json-beatmaps').text)['data']
      paging:
        page: 1
        url: '/beatmaps/search'
        loading: false
        more: true
      filters:
        mode: 0
        status: 0
        genre: null
        language: null
        extra: null
        rank: null
      loading: false
    }

  getFilterState: ->
    {
      'm': @state.filters.mode
      's': @state.filters.status
      'g': @state.filters.genre
      'l': @state.filters.language
      'e': @state.filters.extra
      'r': @state.filters.rank
    }

  search: ->
    searchText = $('#searchbox').val()
    # if (searchText == '' || searchText == null)
    #   return;

    @showLoader()

    $.ajax(@state.paging.url,
      method: 'get'
      dataType: 'json'
      data: $.extend({}, @getFilterState(), 'q': searchText)).done ((data) ->
      @setState
        beatmaps: data['data']
        paging:
          page: 1
          url: @state.paging.url
          loading: false
          more: true
        loading: false
      $(document).trigger 'beatmap:search:done'
    ).bind(this)

  loadMore: ->
    if @state.loading or @state.paging.loading or !@state.paging.more
      return

    searchText = $('#searchbox').val()

    $.ajax(@state.paging.url,
      method: 'get'
      dataType: 'json'
      data: $.extend({}, @getFilterState(),
        'q': searchText
        'page': @state.paging.page + 1)).done ((data) ->
      if data['data'].length > 0
        @setState
          beatmaps: @state.beatmaps.concat(data['data'])
          paging:
            page: @state.paging.page + 1
            url: @state.paging.url
            more: true
          loading: false
      else
        @setState
          beatmaps: @state.beatmaps
          paging:
            page: @state.paging.page
            url: @state.paging.url
            more: false
          loading: false
    ).bind(this)

  showLoader: ->
    @setState loading: true
    $('#loading-area').show()

  hideLoader: ->
    @setState loading: false
    $('#loading-area').hide()

  updateFilters: (lets_ignore_this, b) ->
    newFilters = $.extend({}, @state.filters)
    # clone object
    newFilters[b.name] = b.value
    if @state.filters != newFilters
      @setState { filters: newFilters }, ->
        $(document).trigger 'beatmap:search:start'

  componentDidMount: ->
    $(document).on 'beatmap:load_more', @loadMore
    $(document).on 'beatmap:search:start', @search
    $(document).on 'beatmap:search:done', @hideLoader
    $(document).on 'beatmap:search:filtered', @updateFilters
    $(document).on 'ready page:load osu:page:change', ->
      setTimeout @onScroll, 1000

  componentWillUnmount: ->
    $(document).off 'beatmap:load_more'
    $(document).off 'beatmap:search:start'
    $(document).off 'beatmap:search:done'
    $(document).off 'beatmap:search:filtered'

  render: ->
    searchBackground = undefined
    if @state.beatmaps.length > 0
      searchBackground = '//b.ppy.sh/thumb/' + @state.beatmaps[0].beatmapset_id + 'l.jpg'
    else
      searchBackground = ''

    div null,
      el(SearchPanel, background: searchBackground)
      div id: 'beatmaps', class: 'beatmaps padding',
        el(BeatmapsListing, beatmaps: @state.beatmaps, loading: @state.loading)
        el(Paginator, paging: @state.paging)
)

$(document).ready ->
  React.render el(Beatmaps), document.getElementsByClassName('content')[0]
