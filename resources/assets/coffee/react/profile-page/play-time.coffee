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
import { span } from 'react-dom-factories'
import { ValueDisplay } from 'value-display'
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
