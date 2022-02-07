# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { div } from 'react-dom-factories'

export ScoreboardTab = (props) ->
  className = 'page-tabs__tab'
  className += ' page-tabs__tab--active' if props.active

  div
    className: className
    onClick: ->
      $.publish 'beatmapset:scoreboard:set', scoreboardType: props.type
    osu.trans "beatmapsets.show.scoreboard.#{props.type}"
