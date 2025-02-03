// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare module 'twitch-embed-player' {
  // (2024-03-26) see https://dev.twitch.tv/docs/embed/video-and-clips/ for all options.
  export default class TwitchEmbedPlayer {
    static PLAY: string;

    constructor(id: string, options: Record<string, unknown>);
    addEventListener(action: string, callback: () => void): void;
  }
}
