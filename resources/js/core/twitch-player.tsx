// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type TwitchEmbedPlayer from 'twitch-embed-player';
import { fail } from 'utils/fail';
import TurbolinksReload from './turbolinks-reload';

declare global {
  interface Window {
    Twitch?: {
      Embed: unknown; // unused
      Player: typeof TwitchEmbedPlayer;
    };
  }
}

export default class TwitchPlayer {

  constructor(private readonly turbolinksReload: TurbolinksReload) {
    document.addEventListener('turbo:load', this.startAll);
  }

  initializeEmbed() {
    this.turbolinksReload
      .load('https://player.twitch.tv/js/embed/v1.js')
      ?.then(this.startAll);
  }

  start(div: HTMLElement) {
    if (window.Twitch == null
      || div.dataset.twitchPlayerStarted === 'true') return;

    div.dataset.twitchPlayerStarted = 'true';
    const options = {
      channel: div.dataset.channel ?? fail(`twitch player ${div.id} is missing channel data`),
      height: '100%',
      muted: div.dataset.muted === 'true',
      width: '100%',
    };

    new window.Twitch.Player(div.id, options);
  }

  startAll = () => {
    const playerDivs = document.querySelectorAll('.js-twitch-player');

    if (playerDivs.length === 0) return;

    if (window.Twitch == null) {
      this.initializeEmbed();
    } else {
      for (const div of playerDivs) {
        if (div instanceof HTMLElement) {
          this.start(div);
        }
      }
    }
  };
}
