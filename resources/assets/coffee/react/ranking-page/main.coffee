###
# Copyright 2016 ppy Pty. Ltd.
#
# This file is part of osu!web. osu!web is distributed with the hope of
# attracting more community contributions to the core ecosystem of osu!.
#
# osu!web is free software: you can redistribute it and/or modify
# it under the terms of the Affero GNU General Public License version 3
# as published by the Free Software Foundation.
#
# osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
# warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
###
{div} = React.DOM
el = React.createElement

RankingPage.Main = React.createClass
  mixins: [ScrollingPageMixin]

  setHash: ->
    osu.setHash RankingPageHash.generate(country: @state.currentCountry, mode: @state.currentMode, page: @state.currentPage)

  getInitialState: ->
    optionsHash = RankingPageHash.parse location.hash
    
    loading: false
    currentMode: @validMode(optionsHash.mode)
    currentCountry: @validCountry(optionsHash.country)
    currentPage: @validPage(optionsHash.page)
    lastPage: 1
    friends: false
    scores: []


  setCurrentScoreboard: (_e, {mode = @state.currentMode, country = @state.currentCountry, page = 1, friends = @state.friends, forceReload = false}) ->
    return if @state.loading

    mode = @validMode(mode)
    country = @validCountry(country)

    @setState
      currentMode: mode
      currentCountry: country
      currentPage: page
      friends: friends
      scores: []
      @setHash

    loadScore = =>
      @setState scores: @scoresCache

    $.publish 'ranking:scoreboard:loading', true
    @setState loading: true

    $.ajax (laroute.route 'ranking.scores.overall'),
      method: 'GET'
      dataType: 'JSON'
      data:
        mode: mode
        country: country
        page: page
        friends: if friends then 1 else 0

    .done (data) =>
      @scoresCache = data.data
      @setState lastPage: data.meta.lastPage
      loadScore()

    .fail osu.ajaxError

    .always =>
      $.publish 'ranking:scoreboard:loading', false
      @setState loading: false


  componentDidMount: ->
    @removeListeners()

    $.subscribe 'ranking:scoreboard:set.rankingPage', @setCurrentScoreboard

    @setCurrentScoreboard null, mode: @state.currentMode, country: @state.currentCountry, page: @state.currentPage


  componentWillUnmount: ->
    @removeListeners()


  removeListeners: ->
    $.unsubscribe '.rankingPage'


  render: ->
    div className: 'osu-layout__section',

      el RankingPage.Header

      div className: 'osu-layout__row',
        el RankingPage.Scoreboard,
          currentMode: @state.currentMode
          currentCountry: @state.currentCountry
          currentPage: @state.currentPage
          lastPage: @state.lastPage
          scores: @state.scores
          countries: @props.countries
          friends: @state.friends


  validMode: (mode) ->
    modes = BeatmapHelper.modes

    if _.includes(modes, mode)
      mode
    else
      modes[0]


  validCountry: (country) ->
    if country of @props.countries
      country
    else
      'all'


  validPage: (page) ->
    if isNaN(page) || page < 1
      page = 1
    else
      page
