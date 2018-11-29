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

{div} = ReactDOMFactories
el = React.createElement

class ProfilePage.Detail extends React.PureComponent
  constructor: (props) ->
    super props

    @state = extended: true


  render: =>
    div className: 'profile-detail',
      div className: 'profile-detail__bar',
        el ProfilePage.DetailBar,
          stats: @props.stats
          toggleExtend: @toggleExtend
          extended: @state.extended
          user: @props.user
      div
        className: if @state.extended then '' else 'hidden'
        div className: 'profile-detail__row profile-detail__row--top',
          div className: 'profile-detail__col profile-detail__col--top-left',
            div className: 'profile-detail__top-left-item',
              el ProfilePage.PlayTime, stats: @props.stats
            div className: 'profile-detail__top-left-item',
              el ProfilePage.MedalsCount, userAchievements: @props.userAchievements
            div className: 'profile-detail__top-left-item',
              el ProfilePage.Pp, stats: @props.stats

          div className: 'profile-detail__col',
            el ProfilePage.RankCount, stats: @props.stats
        div className: 'profile-detail__row',
          div className: 'profile-detail__col profile-detail__col--bottom-left',
            el ProfilePage.RankChart,
              rankHistory: @props.rankHistory
              stats: @props.stats

          div className: 'profile-detail__col profile-detail__col--bottom-right',
            div className: 'profile-detail__bottom-right-item',
              div className: 'value-display value-display--large',
                div className: 'value-display__label',
                  osu.trans('users.show.rank.global_simple')
                div className: 'value-display__value',
                  if @props.stats.rank.global?
                    @props.stats.rank.global.toLocaleString()
                  else
                    '-'

            div className: 'profile-detail__bottom-right-item',
              div className: 'value-display',
                div className: 'value-display__label',
                  osu.trans('users.show.rank.country_simple')
                div className: 'value-display__value',
                  if @props.stats.rank.country?
                    @props.stats.rank.country.toLocaleString()
                  else
                    '-'


  toggleExtend: =>
    @setState extended: !@state.extended
