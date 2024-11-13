// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import type TwitchEmbedPlayer from 'twitch-embed-player';
import { fadeOut } from 'utils/fade';
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
  private readonly playerDivs = document.getElementsByClassName('js-twitch-player');

  constructor(private readonly turbolinksReload: TurbolinksReload) {
    document.addEventListener('turbo:load', this.startAll);
  }

  initializeEmbed() {
    this.turbolinksReload
      .load('https://player.twitch.tv/js/embed/v1.js')
      ?.then(this.startAll);
  }

  noCookieDiv(playerDivId: string) {
    return document.querySelector<HTMLElement>(`.js-twitch-player--no-cookie[data-player-id='${playerDivId}']`);
  }

  openPlayer(div: HTMLElement) {
    if (!div.classList.contains('hidden')) return;

    div.classList.remove('hidden');
    fadeOut(this.noCookieDiv(div.id));
  }

  start(div: HTMLElement) {
    if (window.Twitch == null
      || div.dataset.twitchPlayerStarted === 'true') return;

    div.dataset.twitchPlayerStarted = 'true';
    const options = {
      channel: div.dataset.channel,
      height: '100%',
      width: '100%',
    };

    const player = new window.Twitch.Player(div.id, options);
    player.addEventListener(window.Twitch.Player.PLAY, () => this.openPlayer(div));
  }

  startAll = () => {
    if (this.playerDivs.length === 0) return;

    if (window.Twitch == null) {
      this.initializeEmbed();
    } else {
      for (const div of this.playerDivs) {
        if (div instanceof HTMLElement) {
          this.start(div);
        }
      }
    }
  };
}
