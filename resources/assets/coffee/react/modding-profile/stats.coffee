###
#    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
#    See the LICENCE file in the repository root for full licence text.
###

import * as React from 'react'
import { div, dd, dl, dt } from 'react-dom-factories'
el = React.createElement


export class Stats extends React.PureComponent
  entries = [
    'ranked_and_approved_beatmapset_count'
    'loved_beatmapset_count'
    'unranked_beatmapset_count'
    'graveyard_beatmapset_count'
  ]


  render: =>
    div className: 'profile-stats', entries.map(@renderEntry)


  renderEntry: (key) =>
    dl
      className: 'profile-stats__entry'
      key: key
      dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
      dd className: 'profile-stats__value', osu.formatNumber(@props.user[key])
