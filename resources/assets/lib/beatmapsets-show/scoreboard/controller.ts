// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import BeatmapExtendedJson from 'interfaces/beatmap-extended-json';
import { SoloScoreJsonForBeatmap } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, reaction, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import ScoreboardType from './scoreboard-type';

interface SetOptions {
  forceReload?: boolean;
  resetMods?: boolean;
  toggleMod?: string | null;
  type?: ScoreboardType;
}

export type ScoreLoadingState = null | 'error' | 'loading' | 'supporter_only' | 'unranked';

interface UserScore {
  position: number;
  score: SoloScoreJsonForBeatmap;
}

interface BeatmapScoresJson {
  scores: SoloScoreJsonForBeatmap[];
  user_score?: UserScore;
}

interface State {
  currentType: ScoreboardType;
  data: BeatmapScoresJson;
  enabledMods: string[];
  loadingState: ScoreLoadingState;
}

export default class Controller {
  @observable state: State;
  private dataCache: Record<string, State['data']> = {};
  private disposers = new Set<(() => void) | undefined>();
  private xhr: JQuery.jqXHR<BeatmapScoresJson> | null = null;

  get beatmap() {
    return this.getBeatmap();
  }

  @computed
  get enabledMods() {
    return new Set(this.state.enabledMods);
  }

  constructor(private container: HTMLElement, private getBeatmap: () => BeatmapExtendedJson) {
    let state: State | null = null;
    try {
      state = JSON.parse(this.container.dataset.scoreboardState ?? 'null') as (State | null);
    } catch {
      // Do nothing if failed parsing.
    }

    const reset = state == null;
    let reload = false;

    if (state != null && state.loadingState === 'loading') {
      state.loadingState = null;
      reload = true;
    }

    this.state = state ?? {
      currentType: 'global',
      data: { scores: [] },
      enabledMods: [],
      loadingState: null,
    };

    makeObservable(this);

    $(document).on('turbolinks:before-cache', this.saveState);

    if (reset) {
      this.setCurrent({ resetMods: true, type: 'global' });
    } else if (reload) {
      this.setCurrent({});
    }

    this.disposers.add(reaction(
      () => `${this.beatmap.mode}:${this.beatmap.id}`,
      () => this.setCurrent({ resetMods: true, type: 'global' }),
    ));
  }

  destroy() {
    this.xhr?.abort();
    this.disposers.forEach((d) => d?.());
    this.saveState();
    $(document).off('turbolinks:before-cache', this.saveState);
  }

  @action
  readonly setCurrent = (options: SetOptions) => {
    const toggleMod = options.toggleMod ?? null;
    const forceReload = options.forceReload ?? false;
    const resetMods = options.resetMods ?? false;

    this.xhr?.abort();

    if (resetMods) {
      this.state.enabledMods = [];
    } else {
      if (toggleMod != null) {
        const currentEnabledModIndex = this.state.enabledMods.indexOf(toggleMod);

        if (currentEnabledModIndex === -1) {
          this.state.enabledMods.push(toggleMod);
        } else {
          this.state.enabledMods.splice(currentEnabledModIndex, 1);
        }
      }
    }

    if (options.type != null) {
      this.state.currentType = options.type;
    }

    const beatmap = this.beatmap;

    if (!beatmap.is_scoreable) {
      this.state.loadingState = 'unranked';
      return;
    }

    if (!core.currentUser?.is_supporter && (this.state.currentType !== 'global' || this.state.enabledMods.length > 0)) {
      this.state.loadingState = 'supporter_only';
      return;
    }

    const cacheKey = `${beatmap.id}-${beatmap.mode}-${this.state.enabledMods.sort().join(':')}-${this.state.currentType}`;

    const cachedScores = this.dataCache[cacheKey];
    if (!forceReload && cachedScores != null) {
      this.state.data = cachedScores;
      return;
    }

    this.state.loadingState = 'loading';

    this.xhr = $.ajax(route('beatmaps.scores', { beatmap: beatmap.id }), {
      data: {
        mode: beatmap.mode,
        mods: this.state.enabledMods,
        type: this.state.currentType,
      },
      dataType: 'JSON',
      method: 'GET',
    });
    this.xhr.done((data) => runInAction(() => {
      this.dataCache[cacheKey] = this.state.data = data;
      this.state.loadingState = null;
    })).fail(action(() => {
      this.state.loadingState = 'error';
    }));
  };

  private readonly saveState = () => {
    this.container.dataset.scoreboardState = JSON.stringify(this.state);
  };
}
