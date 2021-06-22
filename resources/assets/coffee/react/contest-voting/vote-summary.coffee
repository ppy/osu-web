# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span } from 'react-dom-factories'

baseClass = osu.classWithModifiers('contest__voting-star', ['smaller'])
selectedClass = 'contest__voting-star--selected'

export VoteSummary = ({voteCount, maxVotes}) ->
  div
    className: 'js-contest-vote-summary'
    'data-contest-max-votes': maxVotes
    'data-contest-vote-count': voteCount
    for i in [0...maxVotes]
      className = baseClass
      className += " #{selectedClass}" if i < voteCount

      div
        key: "vote-#{i}"
        className: className
        span className: 'fas fa-fw fa-star'
