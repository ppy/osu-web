// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import * as React from 'react';
import { classWithModifiers, Modifiers } from 'utils/css';

interface Props {
  maxLength: number;
  message: string;
  modifiers?: Modifiers;
}

function modifier(message: string, maxLength: number) {
  if (message.length > maxLength) {
    return 'over';
  } else if (message.length > maxLength * 0.95) {
    return 'almost-over';
  }

  return null;
}

export default function MessageLengthCounter({ maxLength, message, modifiers }: Props) {
  return (
    <div className={classWithModifiers('message-length-counter', modifier(message, maxLength), modifiers)}>
      {`${message.length} / ${maxLength}`}
    </div>
  );
}
