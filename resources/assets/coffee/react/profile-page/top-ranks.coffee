###
#  Copyright 2015 ppy Pty. Ltd.
#
#  This file is part of osu!web. osu!web is distributed with the hope of
#  attracting more community contributions to the core ecosystem of osu!.
#
#  osu!web is free software: you can redistribute it and/or modify
#  it under the terms of the Affero GNU General Public License version 3
#  as published by the Free Software Foundation.
#
#  osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
#  warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
#  See the GNU Affero General Public License for more details.
#
#  You should have received a copy of the GNU Affero General Public License
#  along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
#
###

{div, h2, h3, ul, li, a, p, pre, span} = React.DOM
el = React.createElement

ProfilePage.TopRanks = React.createClass
  mixins: [React.addons.PureRenderMixin]

  getInitialState: ->
    showingBest: 5
    showingFirst: 5


  _showMore: (key, e) ->
      e.preventDefault()

      @setState "#{key}": (@state[key] + 5)


  render: ->
    div
      className: 'profile-extra'
      @props.header

      div null,
        h3 className: 'profile-extra__title profile-extra__title--small', Lang.get('users.show.extra.top_ranks.best.title')
        if @props.scoresBest && @props.scoresBest.length
          div className: 'profile-extra-entries',
            @props.scoresBest.map (score, i) =>
              el PlayDetail, key: i, score: score, shown: i <  @state.showingBest
            if @state.showingBest < @props.scoresBest.length
              li className: 'profile-extra-entries__item profile-extra-entries__item--show-more',
                a href: '#', onClick: @_showMore.bind(@, 'showingBest'), Lang.get('common.buttons.show_more')
        else
          p className: 'profile-extra-entries', Lang.get('users.show.extra.top_ranks.empty')

      div null,
        h3 className: 'profile-extra__title profile-extra__title--small', Lang.get('users.show.extra.top_ranks.first.title')
        if @props.scoresFirst && @props.scoresFirst.length
          div className: 'profile-extra-entries',
            @props.scoresFirst.map (score, i) =>
              el PlayDetail, key: i, score: score, shown: i < @state.showingFirst
            if @state.showingFirst < @props.scoresFirst.length
              li className: 'profile-extra-entries__item profile-extra-entries__item--show-more',
                a href: '#', onClick: @_showMore.bind(@, 'showingFirst'), Lang.get('common.buttons.show_more')
        else
          p className: 'profile-extra-entries', Lang.get('users.show.extra.top_ranks.empty')
