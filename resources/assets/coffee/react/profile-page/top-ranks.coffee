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

{div, h2, h3, ul, li, a, p, pre, span} = ReactDOMFactories
el = React.createElement

class ProfilePage.TopRanks extends React.PureComponent
  render: =>
    div
      className: 'page-extra'
      el ProfilePage.ExtraHeader, name: @props.name, withEdit: @props.withEdit

      div null,
        h3 className: 'page-extra__title page-extra__title--small', osu.trans('users.show.extra.top_ranks.best.title')
        if @props.scoresBest?.length
          div className: 'profile-extra-entries',
            @props.scoresBest.map (score, i) =>
              el PlayDetail, key: i, score: score
            li className: 'profile-extra-entries__item',
              el ProfilePage.ShowMoreLink,
                collection: @props.scoresBest
                propertyName: 'scoresBest'
                pagination: @props.pagination['scoresBest']
                route: laroute.route 'users.scores',
                  user: @props.user.id
                  type: 'best'
                  mode: @props.currentMode
        else
          p className: 'profile-extra-entries', osu.trans('users.show.extra.top_ranks.empty')

      div null,
        h3 className: 'page-extra__title page-extra__title--small', osu.trans('users.show.extra.top_ranks.first.title')
        if @props.scoresFirsts?.length
          div className: 'profile-extra-entries',
            @props.scoresFirsts.map (score, i) =>
              el PlayDetail, key: i, score: score
            li className: 'profile-extra-entries__item',
              el ProfilePage.ShowMoreLink,
                collection: @props.scoresFirsts
                propertyName: 'scoresFirsts'
                pagination: @props.pagination['scoresFirsts']
                route: laroute.route 'users.scores',
                  user: @props.user.id
                  type: 'firsts'
                  mode: @props.currentMode
        else
          p className: 'profile-extra-entries', osu.trans('users.show.extra.top_ranks.empty')
