###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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


class ProfilePage.DetailMobile extends React.PureComponent
  render: =>
    div className: 'profile-detail-mobile',
      if @props.stats.is_ranked
        div className: 'profile-detail-mobile__item profile-detail-mobile__item--rank-chart',
          el ProfilePage.RankChart,
            rankHistory: @props.rankHistory
            stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el ProfilePage.Rank, type: 'global', stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el ProfilePage.Rank, type: 'country', stats: @props.stats
      div className: 'profile-detail-mobile__item',
        el ProfilePage.PlayTime, stats: @props.stats
      div className: 'profile-detail-mobile__item profile-detail-mobile__item--half',
        el ProfilePage.MedalsCount, userAchievements: @props.userAchievements
      div className: 'profile-detail-mobile__item profile-detail-mobile__item--half',
        el ProfilePage.Pp, stats: @props.stats
