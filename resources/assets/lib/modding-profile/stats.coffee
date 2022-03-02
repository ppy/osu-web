# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, dd, dl, dt } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'

entries = [
  'ranked_beatmapset_count'
  'loved_beatmapset_count'
  'pending_beatmapset_count'
  'graveyard_beatmapset_count'
]

export class Stats extends React.PureComponent
  render: =>
    div
      className: classWithModifiers 'profile-stats', 'modding'
      entries.map(@renderEntry)


  renderEntry: (key) =>
    dl
      className: 'profile-stats__entry'
      key: key
      dt className: 'profile-stats__key', osu.trans("users.show.stats.#{key}")
      dd className: 'profile-stats__value', osu.formatNumber(@props.user[key])
