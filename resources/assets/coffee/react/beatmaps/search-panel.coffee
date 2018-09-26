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

{div,a,i,input,h1,h2} = ReactDOMFactories
el = React.createElement

class Beatmaps.SearchPanel extends React.PureComponent
  constructor: (props) ->
    super props

    @prevText = null
    @debouncedSubmit = _.debounce @submit, 500


  componentDidMount: =>
    $(document).on 'turbolinks:before-cache.beatmaps-search-cache', @componentWillUnmount


  componentWillUnmount: =>
    $(document).off '.beatmaps-search-cache'
    @debouncedSubmit.cancel()


  render: =>
    div
      className: 'osu-page osu-page--beatmapsets-search-header'
      if currentUser.id?
        @renderUser()
      else
        @renderGuest()


  onInput: (event) =>
    event.persist()
    @debouncedSubmit event


  renderGuest: =>
    div
      ref: @props.innerRef
      className: 'beatmapsets-search'
      div
        className: 'osu-page-header__background'
        style:
          backgroundImage: osu.urlPresence(@props.background)
      div className: 'fancy-search fancy-search--beatmapsets js-user-link',
        input
          className: 'fancy-search__input'
          disabled: true
          type: 'textbox'
          placeholder: osu.trans('beatmaps.listing.search.login_required')
        div className: 'fancy-search__icon',
          i className: 'fas fa-search'


  renderUser: =>
    filters = @props.availableFilters

    div
      ref: @props.innerRef
      className: "beatmapsets-search #{'beatmapsets-search--expanded' if @props.isExpanded}"
      div
        className: 'beatmapsets-search__background'
        style:
          backgroundImage: osu.urlPresence(@props.background)
      div className: 'fancy-search fancy-search--beatmapsets',
        input
          className: 'fancy-search__input js-beatmapsets-search-input'
          type: 'textbox'
          name: 'search'
          placeholder: osu.trans('beatmaps.listing.search.prompt')
          onInput: @onInput
          defaultValue: @props.filters.query
        div className: 'fancy-search__icon',
          i className: 'fas fa-search'

      el Beatmaps.SearchFilter,
        name: 'general'
        title: osu.trans('beatmaps.listing.search.filters.general')
        options: filters.general
        default: @props.filterDefaults.general
        multiselect: true
        selected: @props.filters.general

      el Beatmaps.SearchFilter,
        name: 'mode'
        title: osu.trans('beatmaps.listing.search.filters.mode')
        options: filters.modes
        default: @props.filterDefaults.mode
        selected: @props.filters.mode

      el Beatmaps.SearchFilter,
        name: 'status'
        title: osu.trans('beatmaps.listing.search.filters.status')
        options: filters.statuses
        default: @props.filterDefaults.status
        selected: @props.filters.status

      a
        className: 'beatmapsets-search__expand-link'
        href: '#'
        onClick: @props.expand
        div {}, osu.trans('beatmaps.listing.search.options')
        div {}, i className: 'fas fa-angle-down'

      div className: 'beatmapsets-search__advanced',
        el Beatmaps.SearchFilter,
          name: 'genre'
          title: osu.trans('beatmaps.listing.search.filters.genre')
          options: filters.genres
          default: @props.filterDefaults.genre
          selected: @props.filters.genre

        el Beatmaps.SearchFilter,
          name: 'language'
          title: osu.trans('beatmaps.listing.search.filters.language')
          options: filters.languages
          default: @props.filterDefaults.language
          selected: @props.filters.language

        el Beatmaps.SearchFilter,
          name: 'extra'
          title: osu.trans('beatmaps.listing.search.filters.extra')
          options: filters.extras
          multiselect: true
          selected: @props.filters.extra

        el Beatmaps.SearchFilter,
          name: 'rank'
          title: osu.trans('beatmaps.listing.search.filters.rank')
          options: filters.ranks
          multiselect: true
          selected: @props.filters.rank

        el Beatmaps.SearchFilter,
          name: 'played'
          title: osu.trans('beatmaps.listing.search.filters.played')
          options: filters.played
          default: @props.filterDefaults.played
          selected: @props.filters.played


  submit: (e) =>
    text = e.target.value.trim()

    if text == @prevText
      return

    @prevText = text

    $(document).trigger 'beatmap:search:filtered', query: text
