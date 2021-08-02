# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div, span } from 'react-dom-factories'
import { classWithModifiers } from 'utils/css'

baseClass = classWithModifiers('contest__voting-star', ['smaller'])
selectedClass = 'contest__voting-star--selected'

export VoteSummary = ({voteCount, maxVotes}) ->
  div
    className: 'js-contest-vote-summary'
    'data-contest-vote-summary': JSON.stringify({maxVotes, voteCount})
    for i in [0...maxVotes]
      className = baseClass
      className += " #{selectedClass}" if i < voteCount

      div
        key: "vote-#{i}"
        className: className
        span className: 'fas fa-fw fa-star'
