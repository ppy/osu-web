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
{div, input, h3, label, span} = React.DOM
el = React.createElement

bn = 'ranking-scoreboard'

class RankingPage.Subheader extends React.Component
  _onChange: (e) =>
    if @props.loading
      e.target.checked = !e.target.checked
    else
      $.publish 'ranking:scoreboard:set', friends: e.target.checked

  render: ->
    div null,
      h3 null,
        if @props.currentCountry == 'all'
          osu.trans 'ranking.overall.global'
        else
          osu.trans 'ranking.overall.national',
            country: @props.countries[@props.currentCountry].name
      if currentUser.id? && currentUser.isSupporter
        div className: "#{bn}__friends",
          label
            className: 'osu-checkbox',
            input
              className: 'osu-checkbox__input',
              type: 'checkbox',
              checked: @props.friends,
              onChange: @_onChange
            span
              className: 'osu-checkbox__tick',
              span className: 'fa fa-check'
          span
            null,
            osu.trans 'ranking.friends'
        
