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
import { div } from 'react-dom-factories'

bn = 'beatmap-discussion-message-length-counter'

export MessageLengthCounter = ({message, isTimeline}) ->
  return null if !isTimeline

  maxLength = BeatmapDiscussionHelper.MAX_LENGTH_TIMELINE

  counterClass = bn
  if message.length > maxLength
    counterClass += " #{bn}--over"
  else if message.length > (maxLength * 0.95)
    counterClass += " #{bn}--almost-over"

  div
    className: counterClass
    "#{message.length} / #{maxLength}"
