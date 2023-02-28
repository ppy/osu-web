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
  blank?: true;
  scores: SoloScoreJsonForBeatmap[];
  user_score?: UserScore;
}

interface StoredState {
  allData: Record<string, BeatmapScoresJson>;
  currentType: ScoreboardType;
  enabledMods: string[];
}

export default class Controller {
  @observable currentType: ScoreboardType = 'global';
  @observable enabledMods = new Set<string>();

  @observable private allData: Record<string, BeatmapScoresJson> = {};
  private disposers = new Set<(() => void) | undefined>();
  private xhr: JQuery.jqXHR<BeatmapScoresJson> | null = null;
  @observable private xhrState: 'error' | 'loading' | null = null;

  get beatmap() {
    return this.getBeatmap();
  }

  @computed
  get currentDataKey() {
    const beatmap = this.beatmap;

    return `${beatmap.id}-${beatmap.mode}-${[...this.enabledMods].sort().join(':')}-${this.currentType}`;
  }

  @computed
  get data() {
    return this.allData[this.currentDataKey] ?? { blank: true, scores: [] };
  }

  @computed
  get loadingState(): ScoreLoadingState {
    if (!this.beatmap.is_scoreable) {
      return 'unranked';
    }

    if (!core.currentUser?.is_supporter && (this.currentType !== 'global' || this.enabledMods.size > 0)) {
      return 'supporter_only';
    }

    return this.xhrState;
  }

  constructor(private container: HTMLElement, private getBeatmap: () => BeatmapExtendedJson) {
    let storedState: StoredState | null = null;
    try {
      storedState = JSON.parse(this.container.dataset.scoreboardState ?? 'null') as (StoredState | null);
    } catch {
      // Do nothing if failed parsing.
    }

    if (storedState != null) {
      this.currentType = storedState.currentType;
      this.allData = storedState.allData;
      this.enabledMods = new Set(storedState.enabledMods);
    }

    makeObservable(this);

    $(document).on('turbolinks:before-cache', this.storeState);

    // fetch score data if needed
    this.setCurrent({});

    this.disposers.add(reaction(
      () => `${this.beatmap.mode}:${this.beatmap.id}`,
      () => this.setCurrent({ resetMods: true, type: 'global' }),
    ));
  }

  destroy() {
    this.xhr?.abort();
    this.disposers.forEach((d) => d?.());
    this.storeState();
    $(document).off('turbolinks:before-cache', this.storeState);
  }

  @action
  readonly setCurrent = (options: SetOptions) => {
    const toggleMod = options.toggleMod ?? null;
    const forceReload = options.forceReload ?? false;
    const resetMods = options.resetMods ?? false;

    this.xhr?.abort();

    if (resetMods) {
      this.enabledMods.clear();
    } else {
      if (toggleMod != null) {
        if (this.enabledMods.has(toggleMod)) {
          this.enabledMods.delete(toggleMod);
        } else {
          this.enabledMods.add(toggleMod);
        }
      }
    }

    if (options.type != null) {
      this.currentType = options.type;
    }

    const beatmap = this.beatmap;

    if (!forceReload && !this.data.blank) {
      this.xhrState = null;
      return;
    }

    this.xhrState = 'loading';
    const dataKey = this.currentDataKey;
    this.xhr = $.ajax(route('beatmaps.scores', { beatmap: beatmap.id }), {
      data: {
        mode: beatmap.mode,
        mods: [...this.enabledMods],
        type: this.currentType,
      },
      dataType: 'JSON',
      method: 'GET',
    });
    this.xhr.done((data) => runInAction(() => {
      this.allData[dataKey] = data;
      this.xhrState = null;
    })).fail((_xhr, status) => runInAction(() => {
      this.xhrState = status === 'abort' ? null : 'error';
    }));
  };

  private readonly storeState = () => {
    const state: StoredState = {
      allData: this.allData,
      currentType: this.currentType,
      enabledMods: [...this.enabledMods],
    };

    this.container.dataset.scoreboardState = JSON.stringify(state);
  };
}
