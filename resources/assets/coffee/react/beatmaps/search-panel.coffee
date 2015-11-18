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

{div,a,i,input,h1,h2} = React.DOM
el = React.createElement

class @SearchPanel extends React.Component
  keyDelay: null
  prevText: null
  search_url: '/beatmaps/search'

  constructor: (props) ->
    super props
    @state =
      filters: JSON.parse(document.getElementById('json-filters').text)['data']

  keypressed: ->
    text = $('#searchbox').val().trim()

    if (@prevText == null and (text == null or text == '')) or text == @prevText
      return

    @prevText = text
    if @keyDelay != null
      clearTimeout @keyDelay
    @keyDelay = setTimeout(@submit.bind(this), 500)

  submit: ->
    searchText = @prevText
    $(document).trigger 'beatmap:search:start'

  componentDidMount: ->
    $('#searchbox').on 'keyup', @keypressed.bind(this)

  componentWillUnmount: ->
    $('#searchbox').off 'keyup'

  show_more: (i, e) ->
    e.preventDefault
    $('#search').addClass 'expanded'

  render: ->
    background = {backgroundImage: "url(#{@props.background})"}
    filters = @state.filters

    if (currentUser.id == undefined)
      div id: 'forum-index-header', className: 'beatmaps-header osu-layout__row osu-layout__row--page',
        div className: 'background', style: background
        div className: 'text-area',
          div className: 'text',
            h2 {}, 'witty tag line'
            h1 {}, 'beatmaps'
    else
      div id: 'search', className: 'osu-layout__row osu-layout__row--page',
        div className: 'background', style: background
        div className: 'box',
          input id: 'searchbox', type: 'textbox', name: 'search', placeholder: Lang.get("beatmaps.listing.search.prompt")
          i className:'fa fa-search'

        el(SearchFilter, name: 'mode', title: 'Mode', options: filters.modes, default: 0)
        el(SearchFilter, name:'status', title: 'Rank Status', options: filters.statuses, default: 0)

        div className: 'more',
          a className: 'toggle', href:'#', onMouseDown: @show_more,
            div {}, Lang.get('beatmaps.listing.search.options')
            div {}, i className:'fa fa-angle-down'

          el(SearchFilter, name: 'genre', title: 'Genre', options: filters.genres, default: filters.genres[0]['id'])
          el(SearchFilter, name: 'language', title: 'Language', options: filters.languages, default: filters.languages[0]['id'])
          el(SearchFilter, name: 'extra', title: 'Extra', options: filters.extras, multiselect: true)
          if currentUser.isSupporter
            el(SearchFilter, name: 'rank', title: 'Rank Achieved', options: filters.ranks, multiselect: true)
