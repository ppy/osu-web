# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

import * as React from 'react'
import { span } from 'react-dom-factories'
import ValueDisplay from 'value-display'
el = React.createElement


export PlayTime = ({stats}) ->
  playTime = moment.duration stats.play_time, 'seconds'

  daysLeftOver = Math.floor playTime.asDays()
  hours = playTime.hours()
  totalMinutes = Math.floor playTime.asMinutes()
  minutes = totalMinutes % 60 # account for seconds rounding

  titleValue = Math.round(playTime.asHours())
  titleUnit = 'hours'

  if titleValue < 2
    titleValue = totalMinutes
    titleUnit = 'minutes'

  title = osu.transChoice("common.count.#{titleUnit}", titleValue)

  timeString = ''
  timeString = "#{osu.formatNumber(daysLeftOver)}d " if daysLeftOver > 0
  timeString += "#{hours}h #{minutes}m"

  el ValueDisplay,
    label: osu.trans('users.show.stats.play_time')
    value:
      span
        title: title
        'data-tooltip-position': 'bottom center'
        timeString
