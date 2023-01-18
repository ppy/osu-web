// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import MessageLengthCounter from 'components/message-length-counter';
import * as React from 'react';
import { maxLengthTimeline } from 'utils/beatmapset-discussion-helper';

interface Props {
  isTimeline: boolean;
  message: string;
}

export default function DiscussionMessageLengthCounter({ message, isTimeline }: Props) {
  if (!isTimeline) return null;

  return <MessageLengthCounter maxLength={maxLengthTimeline} message={message} modifiers='discussion' />;
}
