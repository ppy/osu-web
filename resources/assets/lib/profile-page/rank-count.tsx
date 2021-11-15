# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'
el = React.createElement
ranks =
  XH: 'ssh'
  X: 'ss'
  SH: 'sh'
  S: 's'
  A: 'a'

export class RankCount extends React.PureComponent
  render: =>
    div className: 'profile-rank-count',
      @renderRankCountEntry(name, grade) for name, grade of ranks


  renderRankCountEntry: (name, grade) =>
    div
      key: name
      className: 'profile-rank-count__item'
      div
        className: "score-rank score-rank--#{name} score-rank--profile-page"
      osu.formatNumber(@props.stats.grade_counts[grade])
