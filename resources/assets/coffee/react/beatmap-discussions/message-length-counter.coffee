# Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
# See the LICENCE file in the repository root for full licence text.

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
