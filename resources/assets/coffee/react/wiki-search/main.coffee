###
#    Copyright 2015-2018 ppy Pty. Ltd.
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

{div, input, span} = ReactDOMFactories
el = React.createElement

class @WikiSearch.Main extends React.Component
  constructor: (props) ->
    super props

    @state =
      loading: false
      suggestions: []
      suggestionsVisible: false
      highlightedSuggestion: null

    @suggestionsDebounced = _.debounce @getSuggestions, 500

  getSuggestions: =>
    @xhr = $.ajax laroute.route('search'),
      method: 'GET'
      data:
        mode: 'wiki_page'
        format: 'json'
        query: @refs.input.value
    .done (xhr, status) =>
      @setState
        suggestions: xhr.wiki_page[..9]
        suggestionsVisible: xhr.wiki_page.length > 0
    .always =>
      @setState
        loading: false

  hideSuggestions: =>
    @setState
      suggestionsVisible: false
      highlightedSuggestion: null

  shiftSuggestion: (delta) =>
    if not @state.suggestionsVisible or
    @state.suggestions.length == 0 or
    (@state.highlightedSuggestion == null and delta == -1)
      return

    newPosition = if @state.highlightedSuggestion != null
      @state.highlightedSuggestion + delta
    else
      0

    if newPosition > @state.suggestions.length - 1
      newPosition = @state.highlightedSuggestion
    else if newPosition == -1
      newPosition = null

    @setState
      highlightedSuggestion: newPosition

  highlightSuggestion: (e, position) =>
    @setState
      highlightedSuggestion: position

  resetHighlight: =>
    @setState
      highlightedSuggestion: null

  selectHighlightedSuggestion: =>
    return if not @state.highlightedSuggestion

    Turbolinks.visit laroute.route 'wiki.show',
      page: @state.suggestions[@state.highlightedSuggestion].path

  performSearch: =>
    queryString = @refs.input.value

    return if queryString == ''

    Turbolinks.visit laroute.route 'search',
      mode: 'wiki_page'
      query: queryString

  componentDidMount: ->
    $.subscribe 'suggestion:mouseenter.wikiSearch', @highlightSuggestion
    $.subscribe 'suggestion:mouseleave.wikiSearch', @resetHighlight
    $.subscribe 'suggestion:select.wikiSearch', @selectHighlightedSuggestion

    @refs.input.focus()

  componentWillUnmount: ->
    @xhr?.abort()
    @suggestionsDebounced?.cancel()

    $.unsubscribe '.wikiSearch'

  onInput: (e) =>
    inputNotEmpty = @refs.input.value != ''

    @setState
      suggestions: []
      suggestionsVisible: inputNotEmpty
      loading: inputNotEmpty

    if inputNotEmpty
      @suggestionsDebounced()
    else
      @suggestionsDebounced.cancel()

  onKeyDown: (e) =>
    switch e.keyCode
      when 13  # enter
        if @state.highlightedSuggestion != null
          @selectHighlightedSuggestion()
        else
          @performSearch()
      when 27  # escape
        @hideSuggestions()
      when 38  # up arrow
        @shiftSuggestion -1
      when 40  # down arrow
        if @state.suggestionsVisible == false and @state.suggestions.length > 0
          @setState
            suggestionsVisible: true
            highlightedSuggestion: 0
        else
          @shiftSuggestion 1

  render: ->
    div
      className: 'wiki-search',
      input
        className: 'wiki-search__bar'
        ref: 'input'
        placeholder: osu.trans 'common.input.search'
        onInput: @onInput
        onKeyDown: @onKeyDown
        onBlur: => _.delay @hideSuggestions, 200

      span
        className: 'wiki-search__button fa fa-search'
        onClick: @performSearch

      el WikiSearch.Suggestions,
        loading: @state.loading
        suggestions: @state.suggestions
        visible: @state.suggestionsVisible
        highlighted: @state.highlightedSuggestion
