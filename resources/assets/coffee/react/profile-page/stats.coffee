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

import * as React from 'react'
import { div, dd, dl, dt } from 'react-dom-factories'
el = React.createElement


export class Stats extends React.PureComponent
  entries = [
    'ranked_score'
    'hit_accuracy'
    'play_count'
    'total_score'
    'total_hits'
    'maximum_combo'
    'replays_watched_by_others'
  ]


  render: =>
    div className: 'profile-stats', entries.map(@renderEntry)


  renderEntry: (key) =>
    dl
      className: 'profile-stats__entry'
      key: key
      dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
      dd className: 'profile-stats__value', @formatValue(key)


  formatValue: (key) =>
    val = @props.stats[key]

    switch key
      when 'hit_accuracy' then "#{osu.formatNumber(val, 2)}%"
      else osu.formatNumber(val)
