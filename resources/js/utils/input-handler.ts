// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import core from 'osu-core-singleton';
import { KeyboardEvent } from 'react';

export enum InputEventType {
  Cancel = 'cancel',
  Submit = 'submit',
}

export type TextAreaCallback = (type: InputEventType | null, event: KeyboardEvent<HTMLTextAreaElement>) => void;

export function makeTextAreaHandler(callback: TextAreaCallback) {
  return (event: KeyboardEvent<HTMLTextAreaElement>) => {
    let type: InputEventType | null = null;

    if (event.key === 'Escape') {
      type = InputEventType.Cancel;
    } else if (event.key === 'Enter' && !event.shiftKey && core.windowSize.isDesktop) {
      event.preventDefault();
      type = InputEventType.Submit;
    }

    callback(type, event);
  };
}
