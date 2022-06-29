// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers } from 'utils/css';

interface Props {
  isTimeline: boolean;
  message: string;
}

export default function MessageLengthCounter({ message, isTimeline }: Props) {
  if (!isTimeline) return null;

  const maxLength = BeatmapDiscussionHelper.MAX_LENGTH_TIMELINE;

  let modifier = null;
  if (message.length > maxLength) {
    modifier = 'over';
  } else if (message.length > maxLength * 0.95) {
    modifier = 'almost-over';
  }

  return (
    <div className={classWithModifiers('beatmap-discussion-message-length-counter', modifier)}>
      {`${message.length} / ${maxLength}`}
    </div>
  );
}
