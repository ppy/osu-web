// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import UserPreferences from 'core/user/user-preferences';
import { autorun } from 'mobx';
import Slider from './slider';
import { format, TimeFormat } from './time-format';

type PlayState = 'loading' | 'playing' | 'paused';

const createMainPlayer = () => {
  const player = document.createElement('div');
  player.className = 'audio-player audio-player--main';
  player.innerHTML = `
    <button
      type="button"
      class="audio-player__button audio-player__button--prev js-audio--nav"
      data-audio-nav="prev"
    ><span class="fas fa-fw fa-step-backward"></span></button>

    <button
      type="button"
      class="audio-player__button audio-player__button--play js-audio--main-play"
    ><span class="fa-fw play-button"></span></button>

    <button
      type="button"
      class="audio-player__button audio-player__button--next js-audio--nav"
      data-audio-nav="next"
    ><span class="fas fa-fw fa-step-forward"></span></button>

    <div class="audio-player__bar audio-player__bar--progress js-audio--seek">
      <div class="audio-player__bar-current"></div>
    </div>

    <div class="audio-player__timestamps">
      <div class="audio-player__timestamp audio-player__timestamp--current"></div>
      <div class="audio-player__timestamp-separator">/</div>
      <div class="audio-player__timestamp audio-player__timestamp--total"></div>
    </div>

    <div class="audio-player__volume-control">
      <button type="button" class="audio-player__volume-button js-audio--toggle-mute"></button>
      <div class="audio-player__bar audio-player__bar--volume js-audio--volume">
        <div class="audio-player__bar-current"></div>
      </div>
    </div>

    <div class="audio-player__autoplay-control">
      <button type="button" class="audio-player__autoplay-button js-audio--toggle-autoplay" title="${osu.trans('layout.audio.autoplay')}"></button>
    </div>
  `;

  return player;
};

const createPagePlayer = () => {
  const player = document.createElement('div');
  player.className = 'audio-player js-audio--player';
  player.innerHTML = `
    <button
    type="button"
    class="audio-player__button audio-player__button--play js-audio--play"
    ><span class="fa-fw play-button"></span></button>

    <div class="audio-player__bar audio-player__bar--progress js-audio--seek">
      <div class="audio-player__bar-current"></div>
    </div>

    <div class="audio-player__timestamps">
      <div class="audio-player__timestamp audio-player__timestamp--current"></div>
      <div class="audio-player__timestamp-separator">/</div>
      <div class="audio-player__timestamp audio-player__timestamp--total"></div>
    </div>
  `;

  return player;
};

export default class Main {
  private static readonly ignoredErrors = [
    'AbortError',
    'NotAllowedError',
    'NotSupportedError',
  ];

  audio = new Audio();
  private currentSlider?: Slider;
  private durationFormatted = "'0:00'";
  private hasWorkingVolumeControl = true;
  private hideMainPlayerTimeout = -1;
  private mainPlayer?: HTMLElement;
  private observer?: MutationObserver;
  private pagePlayer?: HTMLElement;
  private playerNext?: HTMLElement;
  private playerPrev?: HTMLElement;
  private settingNavigation = false;
  private state: PlayState = 'paused';
  private timeFormat: TimeFormat = 'minute_minimal';
  private url?: string;

  constructor(private userPreferences: UserPreferences) {
    this.audio.volume = 0;
    this.audio.addEventListener('playing', this.onPlaying);
    this.audio.addEventListener('ended', this.onEnded);
    this.audio.addEventListener('timeupdate', this.onTimeupdate);
    this.audio.addEventListener('volumechange', this.syncVolumeDisplay);

    $(document).on('click', '.js-audio--play', this.onClickPlay);
    $(document).on('click', '.js-audio--main-play', this.togglePlay);
    $(document).on(Slider.startEvents, '.js-audio--seek', this.onSeekStart);
    $(document).on(Slider.startEvents, '.js-audio--volume', this.onVolumeChangeStart);
    $(document).on('click', '.js-audio--toggle-mute', this.toggleMute);
    $(document).on('click', '.js-audio--toggle-autoplay', this.toggleAutoplay);
    $(document).on('click', '.js-audio--nav', this.nav);
    $(document).on('turbolinks:load', this.onDocumentReady);
  }

  private checkVolumeSettings = () => {
    const prevVolume = this.audio.volume;
    const testVolume = prevVolume === 0.1 ? 0.2 : 0.1;
    this.audio.volume = testVolume;
    // Volume control doesn't work on iOS. It sets the value but reset it
    // a moment later; hence use setTimeout to test changing volume.
    // For actual volume settings, see onDocumentReady.
    setTimeout(() => {
      this.hasWorkingVolumeControl = this.audio.volume === testVolume;
      this.audio.volume = prevVolume;
      this.syncVolumeDisplay();
    }, 0);
  };

  private ensurePagePlayerIsAttached = () => {
    if (this.pagePlayer != null && !document.body.contains(this.pagePlayer)) {
      this.pagePlayer = undefined;
    }
  };

  private findPlayer(elem: HTMLElement) {
    const player = (this.mainPlayer?.contains(elem) ?? false) ? this.pagePlayer : elem.closest('.js-audio--player');

    if (player instanceof HTMLElement) {
      return player;
    }
  }

  private load = (player: HTMLElement) => {
    const url = player.dataset.audioUrl;

    if (url == null) {
      throw new Error('Player is missing url');
    }

    if (!this.audio.paused) {
      this.stop();
    }

    this.setTime(0);
    this.pagePlayer = player;

    this.url = url;
    this.audio.setAttribute('src', url);
    this.audio.currentTime = 0;
    this.setState('loading');
    const promise = this.audio.play();
    // old api returns undefined
    promise?.catch((error: { name: string }) => {
      if (Main.ignoredErrors.includes(error.name)) {
        console.debug('playback failed:', error.name);
        this.stop();
        return;
      }
      throw error;
    });

    this.setNavigation();
  };

  private nav = (e: JQuery.ClickEvent) => {
    const button: unknown = e.currentTarget;

    if (!(button instanceof HTMLElement)) return;

    if (button.dataset.audioNav === 'prev' && this.playerPrev != null) {
      this.load(this.playerPrev);
    } else if (button.dataset.audioNav === 'next' && this.playerNext != null) {
      this.load(this.playerNext);
    }
  };

  private observePage = (mutations: MutationRecord[]) => {
    this.ensurePagePlayerIsAttached();
    const audioElems: HTMLAudioElement[] = [];
    const newPlayers: HTMLElement[] = [];
    const findNewPlayers = this.pagePlayer == null;

    mutations.forEach((mutation) => {
      mutation.addedNodes.forEach((node) => {
        if (node instanceof HTMLElement) {
          if (node instanceof HTMLAudioElement) {
            audioElems.push(node);
          } else {
            audioElems.push(...node.querySelectorAll('audio'));
          }

          if (findNewPlayers) {
            if (node.classList.contains('js-audio--player')) {
              newPlayers.push(node);
            } else {
              for (const player of [...node.querySelectorAll('.js-audio--player')]) {
                if (player instanceof HTMLElement) {
                  newPlayers.push(player);
                }
              }
            }
          }
        }
      });
    });

    newPlayers.push(...this.replaceAudioElems(audioElems));
    this.reattachPagePlayer(newPlayers);
  };

  private onClickPlay = (e: JQuery.ClickEvent) => {
    e.preventDefault();

    const pagePlayer = this.findPlayer(e.currentTarget);

    if (pagePlayer == null) {
      throw new Error('couldn\'t find pagePlayer of the play button');
    }

    if (pagePlayer === this.pagePlayer) {
      this.togglePlay();
    } else {
      this.load(pagePlayer);
    }
  };

  private onDocumentReady = () => {
    if (this.mainPlayer == null) {
      const mainPlayerPlaceholder = document.querySelector('.js-audio--main');

      if (mainPlayerPlaceholder == null) {
        console.debug('page is missing main player placeholder');
        return;
      }

      this.mainPlayer = createMainPlayer();
      mainPlayerPlaceholder.replaceWith(this.mainPlayer);

      // This requires currentUser and should only be run once so it's done in here.
      autorun(() => this.audio.muted = this.userPreferences.get('audio_muted'));
      autorun(() => this.audio.volume = this.userPreferences.get('audio_volume'));

      // Only check after initial volume is set otherwise it'll be replaced with the volume at current point
      // due to the check being async.
      this.checkVolumeSettings();

      this.syncState();
    }

    if (this.observer == null) {
      this.observer = new MutationObserver(this.observePage);
      this.observer.observe(document, { childList: true, subtree: true });
    }
    this.replaceAudioElems();
    this.reattachPagePlayer();
  };

  private onEnded = () => {
    this.stop();

    if (this.playerNext != null && this.userPreferences.get('audio_autoplay')) {
      this.load(this.playerNext);
    }
  };

  private onPlaying = () => {
    this.setTimeFormat();
    this.durationFormatted = format(this.audio.duration, this.timeFormat);
    this.setState('playing');
  };

  private onSeekEnd = (slider: Slider) => {
    this.currentSlider = undefined;
    const targetTime = slider.getPercentage() === 1
      ? this.audio.duration - 0.01
      : this.audio.duration * slider.getPercentage();

    this.setTime(targetTime);
  };

  private onSeekStart = (e: JQuery.TouchStartEvent) => {
    const bar: unknown = e.currentTarget;

    if (!(bar instanceof HTMLElement)) return;

    if ((this.pagePlayer == null || !this.pagePlayer.contains(bar)) && (this.mainPlayer == null || !this.mainPlayer.contains(bar))) return;

    if (!Number.isFinite(this.audio.duration) || this.audio.duration === 0) return;

    this.currentSlider = Slider.start({
      bar,
      endCallback: this.onSeekEnd,
      initialEvent: e,
    });
  };

  private onTimeupdate = () => {
    // time update when playing is already handled by a requestAnimationFrame loop
    if (this.audio.paused) {
      this.syncProgress();
    }
  };

  private onVolumeChangeEnd = () => {
    this.currentSlider = undefined;
    void this.userPreferences.set('audio_volume', this.audio.volume);
  };

  private onVolumeChangeMove = (slider: Slider) => {
    this.audio.volume = slider.getPercentage();
  };

  private onVolumeChangeStart = (e: JQuery.TouchStartEvent) => {
    const bar: unknown = e.currentTarget;

    if (!(bar instanceof HTMLElement)) return;

    this.currentSlider = Slider.start({
      bar,
      endCallback: this.onVolumeChangeEnd,
      initialEvent: e,
      moveCallback: this.onVolumeChangeMove,
    });
  };

  private pause = () => {
    this.audio.pause();
    this.setState('paused');
  };

  private reattachPagePlayer = (elems?: Element[]) => {
    this.ensurePagePlayerIsAttached();

    if (this.url != null && this.pagePlayer == null) {
      if (elems == null) {
        elems = [...document.querySelectorAll('.js-audio--player')];
      }

      for (const elem of elems) {
        if (elem instanceof HTMLElement && elem.dataset.audioUrl === this.url) {
          this.pagePlayer = elem;
          this.syncState();
          break;
        }
      }
    }

    this.setNavigation();
  };

  private replaceAudioElem = (elem: HTMLAudioElement) => {
    const src = osu.presence(elem.src) ?? osu.presence(elem.querySelector('source')?.src);

    if (src == null) {
      throw new Error('audio element is missing src');
    }

    const player = createPagePlayer();
    player.dataset.audioUrl = src;
    player.dataset.audioState = 'paused';

    elem.replaceWith(player);

    return player;
  };

  private replaceAudioElems = (elems?: HTMLAudioElement[]) => {
    if (elems == null) {
      elems = [...document.querySelectorAll('audio')];
    }

    return elems.map(this.replaceAudioElem);
  };

  private setNavigation = () => {
    if (this.settingNavigation) {
      return;
    }

    this.settingNavigation = true;

    window.setTimeout(() => {
      this.playerNext = undefined;
      this.playerPrev = undefined;

      const container = this.pagePlayer?.closest('.js-audio--group');

      if (container instanceof HTMLElement) {
        const players = container.querySelectorAll('.js-audio--player');
        for (let i = 0; i < players.length; i++) {
          if (players[i] === this.pagePlayer) {
            if (i > 0) {
              const playerPrev = players[i - 1];
              if (playerPrev instanceof HTMLElement) {
                this.playerPrev = playerPrev;
              }
            }

            const playerNext = players[i + 1];
            if (playerNext instanceof HTMLElement) {
              this.playerNext = playerNext;
            }

            break;
          }
        }
      }

      if (this.mainPlayer != null) {
        this.mainPlayer.dataset.audioHasPrev = this.playerPrev == null ? '0' : '1';
        this.mainPlayer.dataset.audioHasNext = this.playerNext == null ? '0' : '1';
      }

      this.settingNavigation = false;
    });
  };

  private setState = (state: PlayState) => {
    this.state = state;
    this.syncState();

    if (this.state === 'playing' || this.state === 'loading') {
      window.clearTimeout(this.hideMainPlayerTimeout);
      if (this.mainPlayer != null) {
        this.mainPlayer.dataset.audioVisible = '1';
      }
    } else {
      this.hideMainPlayerTimeout = window.setTimeout(() => {
        if (this.mainPlayer != null) {
          this.mainPlayer.dataset.audioVisible = '0';
        }
      }, 4000);
    }
  };

  private setTime = (t: number) => {
    this.audio.currentTime = t;
    this.syncProgress();
  };

  private setTimeFormat = () => {
    if (this.audio.duration < 600) {
      this.timeFormat = 'minute_minimal';
    } else if (this.audio.duration < 3600) {
      this.timeFormat = 'minute';
    } else if (this.audio.duration < 36000) {
      this.timeFormat = 'hour_minimal';
    } else {
      this.timeFormat = 'hour';
    }
  };

  private stop = () => {
    this.audio.pause();
    this.currentSlider?.end();
    this.audio.currentTime = 0;
    this.pause();
  };

  private syncProgress = () => {
    if (this.audio.duration > 0) {
      const progress = this.audio.currentTime / this.audio.duration;
      const over50 = progress >= 0.5 ? '1' : '0';
      const progressFormatted = progress.toString();
      const currentTimeFormatted = format(this.audio.currentTime, this.timeFormat);
      this.updatePlayers((player) => {
        player.style.setProperty('--current-time', currentTimeFormatted);
        player.style.setProperty('--progress', progressFormatted);
        player.dataset.audioOver50 = over50;
      });
    }

    if (!this.audio.paused) {
      requestAnimationFrame(this.syncProgress);
    }
  };

  private syncState = () => {
    this.updatePlayers((player) => {
      player.dataset.audioAutoplay = this.userPreferences.get('audio_autoplay') ? '1' : '0';
      player.dataset.audioHasDuration = Number.isFinite(this.audio.duration) ? '1' : '0';
      player.dataset.audioState = this.state;
      player.dataset.audioTimeFormat = this.timeFormat;
      player.style.setProperty('--duration', this.durationFormatted);
    });

    this.syncProgress();
    this.syncVolumeDisplay();
  };

  private syncVolumeDisplay = () => {
    if (this.mainPlayer == null) return;

    this.mainPlayer.dataset.audioVolumeBarVisible = this.hasWorkingVolumeControl ? '1' : '0';
    this.mainPlayer.dataset.audioVolume = this.volumeIcon();
    this.mainPlayer.style.setProperty('--volume', this.audio.volume.toString());
  };

  private toggleAutoplay = () => {
    void this.userPreferences.set('audio_autoplay', !this.userPreferences.get('audio_autoplay'));
    this.syncState();
  };

  private toggleMute = () => {
    void this.userPreferences.set('audio_muted', !this.userPreferences.get('audio_muted'));
  };

  private togglePlay = () => {
    if (this.url == null) {
      return;
    }

    if (this.audio.paused) {
      void this.audio.play();
    } else {
      this.pause();
    }
  };

  private updatePlayers = (func: (player: HTMLElement) => void) => {
    [this.mainPlayer, this.pagePlayer].forEach((player) => {
      if (player != null) {
        func(player);
      }
    });
  };

  private volumeIcon = () => {
    if (this.audio.muted) {
      return 'muted';
    } else {
      if (this.audio.volume === 0) {
        return 'silent';
      } else if (this.audio.volume < 0.4) {
        return 'quiet';
      } else {
        return 'normal';
      }
    }
  };
}
