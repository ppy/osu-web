// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import DispatcherAction from 'actions/dispatcher-action';
import ChannelJson from 'interfaces/chat/channel-json';

export default class ChannelJoinEvent extends DispatcherAction {
  constructor(readonly json: ChannelJson) {
    super();
  }
}
