// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'twitch-embed-player' {
  export default class TwitchEmbedPlayer {
    static PLAY: string;

    constructor (id: string, options: Record<string, unknown>);
    addEventListener(action: string, callback: () => void): void;
  }
}
