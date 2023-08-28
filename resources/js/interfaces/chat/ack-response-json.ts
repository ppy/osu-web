// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import ChatSilenceJson from 'interfaces/chat/chat-silence-json';

export default interface AckResponseJson {
  silences: ChatSilenceJson[];
}
