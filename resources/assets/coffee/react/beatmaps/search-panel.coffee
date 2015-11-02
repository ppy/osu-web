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

{div,a,i,input} = React.DOM
el = React.createElement

window.SearchPanel = React.createClass
    keyDelay: null
    prevText: null
    search_url: '/beatmaps/search'

    getInitialState: ->
      { filters: JSON.parse(document.getElementById('json-filters').text)['data'] }

    keypressed: ->
      text = $('#searchbox').val()

      if text == null or text == '' or text == @prevText
        return

      @prevText = text
      if @keyDelay != null
        clearTimeout @keyDelay
      @keyDelay = setTimeout(@submit, 500)

    submit: ->
      searchText = @prevText
      $(document).trigger 'beatmap:search:start'

    componentDidMount: ->
      $('#searchbox').on 'keyup', @keypressed

    componentWillUnmount: ->
      $('#searchbox').off 'keyup'

    show_more: ->
      $('#search').addClass 'expanded'
      false

    render: ->
      filters = @state.filters
      div id: 'search',
        div className: 'background', style:
          'background-image': "url(#{@props.background})"
        div className: 'box',
          input id: 'searchbox', type: 'textbox', name: 'search', placeholder: Lang.get("beatmaps.listing.search.prompt")
          i className:'fa fa-search'

        el(FilterSelector, name: 'mode', title: 'Mode', options: filters.modes, default: 0)
        el(FilterSelector, name:'status', title: 'Rank Status', options: filters.statuses, default: 0)

        div className: 'more',
          a className: 'toggle', href:'#', onClick: @show_more,
            div {}, Lang.get('beatmaps.listing.search.options')
            div {}, i className:'fa fa-angle-down'

          el(FilterSelector, name: 'genre', title: 'Genre', options: filters.genres, default: filters.genres[0]['id'])
          el(FilterSelector, name: 'language', title: 'Language', options: filters.languages, default: filters.languages[0]['id'])
          el(FilterSelector, name: 'extra', title: 'Extra', options: filters.extras, multiselect: true)
          el(FilterSelector, name: 'rank', title: 'Rank Achieved', options: filters.ranks, default: null)
