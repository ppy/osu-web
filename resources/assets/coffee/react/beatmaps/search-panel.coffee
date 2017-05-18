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

{div,a,i,input,h1,h2} = React.DOM
el = React.createElement

class Beatmaps.SearchPanel extends React.Component
  constructor: (props) ->
    super props

    @keyDelay = null
    @prevText = null

    @state =
      isExpanded: false
      filters: osu.parseJson('json-filters')


  render: =>
    div
      className: 'osu-page osu-page--beatmapsets-search-header'
      if currentUser.id?
        @renderUser()
      else
        @renderGuest()


  keypressed: (e) =>
    @text = e.target.value.trim()

    Timeout.clear @keyDelay
    @keyDelay = Timeout.set 500, @submit


  renderGuest: =>
    div
      className: 'osu-page-header osu-page-header--beatmapsets-header-guest'
      div
        className: 'osu-page-header__background'
        style:
          backgroundImage: "url(#{@props.background})"
      h1
        className: 'osu-page-header__title'
        'Beatmaps'


  renderUser: =>
    filters = @state.filters

    div
      className: "beatmapsets-search #{'beatmapsets-search--expanded' if @state.isExpanded}"
      div
        className: 'beatmapsets-search__background'
        style:
          backgroundImage: "url(#{@props.background})"
      div className: 'fancy-search fancy-search--beatmapsets',
        input
          className: 'fancy-search__input js-beatmapsets-search-input'
          type: 'textbox'
          name: 'search'
          placeholder: osu.trans("beatmaps.listing.search.prompt")
          onChange: @keypressed
        div className: 'fancy-search__icon',
          i className:'fa fa-search'

      el(Beatmaps.SearchFilter, name: 'mode', title: 'Mode', options: filters.modes, default: '0', selected: @props.filters.mode)
      el(Beatmaps.SearchFilter, name:'status', title: 'Rank Status', options: filters.statuses, default: '0', selected: @props.filters.status)

      a className: 'beatmapsets-search__expand-link', href:'#', onClick: @showMore,
        div {}, osu.trans('beatmaps.listing.search.options')
        div {}, i className:'fa fa-angle-down'

      div className: 'beatmapsets-search__advanced',
        el(Beatmaps.SearchFilter, name: 'genre', title: 'Genre', options: filters.genres, default: filters.genres[0]['id'], selected: @props.filters.genre)
        el(Beatmaps.SearchFilter, name: 'language', title: 'Language', options: filters.languages, default: filters.languages[0]['id'], selected: @props.filters.language)
        el(Beatmaps.SearchFilter, name: 'extra', title: 'Extra', options: filters.extras, multiselect: true, selected: @props.filters.extra)
        if currentUser.isSupporter
          el(Beatmaps.SearchFilter, name: 'rank', title: 'Rank Achieved', options: filters.ranks, multiselect: true, selected: @props.filters.rank)


  showMore: (e) =>
    e.preventDefault()
    @setState isExpanded: true


  submit: =>
    if (!@prevText? && @text == '') || @text == @prevText
      return

    @prevText = @text

    $(document).trigger 'beatmap:search:start'
