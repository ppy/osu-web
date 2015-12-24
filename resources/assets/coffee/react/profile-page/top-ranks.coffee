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

{div, h2, h3, ul, li, p, pre} = React.DOM
el = React.createElement

class ProfilePage.TopRanks extends React.Component
  _renderScoreBest: (score) =>
    li null,
      pre null,
        JSON.stringify score


  render: =>
    div
      className: 'osu-layout__row osu-layout__row--page profile-extra'
      div className: 'profile-extra__anchor js-profile-page-extra--scrollspy', id: 'top_ranks'

      h2 className: 'profile-extra__title', Lang.get('users.show.extra.top_ranks.title')

      div null,
        h3 className: 'profile-extra__sub-title', Lang.get('users.show.extra.top_ranks.best.title')
        if @props.scoresBest && @props.scoresBest.length
          ul className: 'profile-extra-entries',
            @props.scoresBest.map (score) => @_renderScoreBest(score)
        else
          p className: 'profile-extra-entries', Lang.get('scores.empty')
