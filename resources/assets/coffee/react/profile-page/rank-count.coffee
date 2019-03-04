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
ranks = ['XH', 'X', 'SH', 'S', 'A']

class ProfilePage.RankCount extends React.PureComponent
  render: =>
    div className: 'profile-rank-count',
      ranks.map @renderRankCountEntry


  renderRankCountEntry: (name) =>
    div
      key: name
      className: 'profile-rank-count__item'
      div
        className: "score-rank-v2 score-rank-v2--#{name} score-rank-v2--profile-page"
      osu.formatNumber(@props.stats.scoreRanks[name])
