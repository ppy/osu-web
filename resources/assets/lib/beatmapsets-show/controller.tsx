// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

import { BeatmapsetJsonForShow } from 'interfaces/beatmapset-extended-json';
import { SoloScoreJsonForBeatmap } from 'interfaces/solo-score-json';
import { route } from 'laroute';
import { action, computed, makeObservable, observable, reaction, runInAction } from 'mobx';
import core from 'osu-core-singleton';
import { find, findDefault, group } from 'utils/beatmap-helper';
import { parse } from 'utils/beatmapset-page-hash';
import { parseJson } from 'utils/json';
import { currentUrl } from 'utils/turbolinks';
import ScoreboardType from './scoreboard-type';

interface ScoreboardSetOptions {
  enabledMod?: string | null;
  forceReload?: boolean;
  resetMods?: boolean;
  scoreboardType?: ScoreboardType;
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

type BeatmapJsonForBeatmapsetShow = BeatmapsetJsonForShow['converts'][number];

interface State {
  beatmapId?: BeatmapJsonForBeatmapsetShow['id'];
  beatmapset: BeatmapsetJsonForShow;
  currentScoreboardType: ScoreboardType;
  enabledMods: string[];
  playmode?: BeatmapJsonForBeatmapsetShow['mode'];
  scoreLoadingState: ScoreLoadingState;
  scores: BeatmapScoresJson;
  showingNsfwWarning: boolean;
}

export default class Controller {
  @observable hoveredBeatmap: null | BeatmapJsonForBeatmapsetShow = null;
  @observable state: State;
  private disposers = new Set<(() => void) | undefined>();
  private scoreboardXhr: JQuery.jqXHR<BeatmapScoresJson> | null = null;
  private scoresCache: Record<string, State['scores']> = {};

  @computed
  get beatmaps() {
    return group([...this.beatmapset.beatmaps, ...this.beatmapset.converts]);
  }

  get beatmapset() {
    return this.state.beatmapset;
  }

  @computed
  get currentBeatmap() {
    let beatmap: BeatmapJsonForBeatmapsetShow | null | undefined = null;

    if (this.state.playmode != null) {
      if (this.state.beatmapId != null) {
        beatmap ??= find({
          group: this.beatmaps,
          id: this.state.beatmapId,
          mode: this.state.playmode,
        });
      }

      beatmap ??= findDefault({
        items: this.beatmaps.get(this.state.playmode) ?? [],
      });
    }

    beatmap ??= findDefault({
      group: this.beatmaps,
    });

    if (beatmap == null) {
      throw new Error('failed to find default beatmap');
    }

    return beatmap;
  }

  @computed
  get enabledMods() {
    return new Set(this.state.enabledMods);
  }

  constructor(private container: HTMLElement) {
    let state: State | null = null;
    try {
      state = JSON.parse(this.container.dataset.state ?? 'null') as (State | null);
    } catch {
      // Do nothing if failed parsing.
    }

    const resetScores = state == null;
    let reloadScores = false;

    if (state == null) {
      const optionsHash = parse(currentUrl().hash);
      const beatmapset = parseJson<BeatmapsetJsonForShow>('json-beatmapset');

      state = {
        beatmapId: optionsHash.beatmapId,
        beatmapset,
        currentScoreboardType: 'global',
        enabledMods: [],
        playmode: optionsHash.playmode,
        scoreLoadingState: null,
        scores: { scores: [] },
        showingNsfwWarning: beatmapset.nsfw && runInAction(() => !core.userPreferences.get('beatmapset_show_nsfw')),
      };
    } else {
      if (state.scoreLoadingState === 'loading') {
        state.scoreLoadingState = null;
        reloadScores = true;
      }
    }

    this.state = state;

    makeObservable(this);

    $(document).on('turbolinks:before-cache', this.saveState);

    if (resetScores) {
      this.setCurrentScoreboard({ resetMods: true, scoreboardType: 'global' });
    } else if (reloadScores) {
      this.setCurrentScoreboard({});
    }

    this.disposers.add(reaction(
      () => `${this.currentBeatmap.mode}:${this.currentBeatmap.id}`,
      () => this.setCurrentScoreboard({ resetMods: true, scoreboardType: 'global' }),
    ));
  }

  destroy() {
    this.scoreboardXhr?.abort();
    this.disposers.forEach((d) => d?.());
    this.saveState();
    $(document).off('turbolinks:before-cache', this.saveState);
  }

  @action
  readonly setCurrentBeatmap = (beatmap: BeatmapJsonForBeatmapsetShow) => {
    if (beatmap === this.currentBeatmap) return;

    this.state.beatmapId = beatmap.id;
    this.state.playmode = beatmap.mode;
  };

  @action
  readonly setCurrentScoreboard = (options: ScoreboardSetOptions) => {
    const enabledMod = options.enabledMod ?? null;
    const forceReload = options.forceReload ?? false;
    const resetMods = options.resetMods ?? false;

    this.scoreboardXhr?.abort();

    if (resetMods) {
      this.state.enabledMods = [];
    } else {
      if (enabledMod != null) {
        const currentEnabledModIndex = this.state.enabledMods.indexOf(enabledMod);

        if (currentEnabledModIndex === -1) {
          this.state.enabledMods.push(enabledMod);
        } else {
          this.state.enabledMods.splice(currentEnabledModIndex, 1);
        }
      }
    }

    if (options.scoreboardType != null) {
      this.state.currentScoreboardType = options.scoreboardType;
    }

    const currentBeatmap = this.currentBeatmap;

    if (!currentBeatmap.is_scoreable) {
      this.state.scoreLoadingState = 'unranked';
      return;
    }

    if (!core.currentUser?.is_supporter && (this.state.currentScoreboardType !== 'global' || this.state.enabledMods.length > 0)) {
      this.state.scoreLoadingState = 'supporter_only';
      return;
    }

    const cacheKey = `${currentBeatmap.id}-${currentBeatmap.mode}-${this.state.enabledMods.sort().join(':')}-${this.state.currentScoreboardType}`;

    const cachedScores = this.scoresCache[cacheKey];
    if (!forceReload && cachedScores != null) {
      this.state.scores = cachedScores;
      return;
    }

    this.state.scoreLoadingState = 'loading';

    this.scoreboardXhr = $.ajax(route('beatmaps.scores', { beatmap: currentBeatmap.id }), {
      data: {
        mode: currentBeatmap.mode,
        mods: this.state.enabledMods,
        type: this.state.currentScoreboardType,
      },
      dataType: 'JSON',
      method: 'GET',
    });
    this.scoreboardXhr.done((data) => runInAction(() => {
      this.scoresCache[cacheKey] = this.state.scores = data;
      this.state.scoreLoadingState = null;
    })).fail(action(() => {
      this.state.scoreLoadingState = 'error';
    }));
  };

  private readonly saveState = () => {
    this.container.dataset.state = JSON.stringify(this.state);
  };
}
