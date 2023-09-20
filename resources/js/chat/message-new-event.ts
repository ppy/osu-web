// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import MessagesNewJson from 'interfaces/chat/messages-new-json';

export default class MessageNewEvent extends DispatcherAction {
  constructor(readonly json: MessagesNewJson) {
    super();
  }
}
