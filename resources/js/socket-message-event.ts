// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';

export function isSocketEventData(arg: unknown): arg is SocketEventData {
  return typeof arg === 'object'
    && arg != null
    && 'event' in arg;
}

export interface SocketEventData {
  event: string;
}

export default class SocketMessageEvent extends DispatcherAction {
  constructor(readonly message: SocketEventData) {
    super();
  }
}
